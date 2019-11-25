# World Wide Import
### Configuratie om het werkend te krijgen:

- .htaccess (/.htaccess)
    - 
    Verander hierbij de RewriteBase naar de document root waar het project zich in bevindt. 
    Dit zie je in de mappenstructuur van je huidige project in PHPStorm. 
    
    **Voorbeeld**
    
    Als je hebt staan C:/xampp/htdocs/school/wwi verander het dan naar:
    ``RewriteBase /school/wwi``
    
- index.php (/index.php)
    -
    Wijzig hierin de variabele ``sitelink`` met de root directory van je project. 
    Kijk naar de url in de browser. 
   
    **Voorbeeld**
   
    Bekijk wat je bij RewriteBase (/.htacess) hebt geschreven. Kopieer dat en zet dit ervoor ``https://localhost`` 
     
    voorbeeld > ``"http://localhost/school/www/"``
    
    