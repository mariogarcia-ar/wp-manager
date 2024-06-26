#!/bin/bash

lamp_emit_cert() {
    echo "Generating SSL certificate for $NGINX_SERVER_NAME"

    #check if mkcert is installed
    if ! command -v mkcert &> /dev/null
    then
        echo "mkcert could not be found"
        echo "Please install mkcert and run this command again"
        exit
    fi

    cd $PW_SERVICES_DIR"/nginx/certs"

    # Remove the existing certificate and private key
    rm *.pem

    # Generate the certificate and private key
    mkcert $NGINX_SERVER_NAME

    # Rename the certificate and private key
    cp "${NGINX_SERVER_NAME}.pem" public-key.pem
    cp "${NGINX_SERVER_NAME}-key.pem" private-key.pem

    echo "SSL certificate generated successfully for $NGINX_SERVER_NAME in $PW_SERVICES_DIR/nginx/certs/"
}

lamp_download_backup() {
    echo "Downloading the backup from the remote server ..."
    sftp_download_file "$SFTP_REMOTE_FILE" "$PW_TMP_DIR/backup-prod.tar.gz"
    
    cd "$PW_TMP_DIR"
    # Extract the backup
    sudo mkdir -p $PW_SHARED_DIR"/backup-prod/"
    sudo tar -xzf "$PW_TMP_DIR/backup-prod.tar.gz" -C $PW_SHARED_DIR"/backup-prod/"

    echo "Backup downloaded successfully. Files are located in $PW_SHARED_DIR/backup-prod/"
}

lamp_download_plugins() {
    echo "Downloading the plugins from the remote server ..."
    cd "$PW_TMP_DIR"

    mkdir -p $PW_TMP_DIR"/plugins/"
    sftp_download_folder "$SFTP_REMOTE_PLUGINS_FOLDER" "$PW_TMP_DIR"

    sudo mkdir -p $PW_SHARED_DIR"/plugins/"
    sudo cp -r $PW_TMP_DIR"/plugins/"* $PW_SHARED_DIR"/plugins/"

    echo "Plugins downloaded successfully. Files are located in $PW_SHARED_DIR"
}

lamp_download_themes() {
    echo "Downloading the themes from the remote server ..."
    cd "$PW_TMP_DIR"

    mkdir -p $PW_TMP_DIR"/themes/"
    sftp_download_folder "$SFTP_REMOTE_THEMES_FOLDER" "$PW_TMP_DIR"

    sudo mkdir -p $PW_SHARED_DIR"/themes/"
    sudo cp -r $PW_TMP_DIR"/themes/"* $PW_SHARED_DIR"/themes/"

    echo "Themes downloaded successfully. Files are located in $PW_SHARED_DIR"
}