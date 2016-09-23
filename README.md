# sns PHP project
PHP로 sns 서비스 사이트를 구현해 보았다.
    
### Alias Setting
    DocumentRoot "/www/html/"
    Alias /css "/www/css"
    Alias /file "/www/file"
    Alias /include "/www/include"
    <Directory "/www/">
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>
