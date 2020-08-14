# BoolBnB

BoolBnB è una applicazione per trovare e gestire l’affitto di appartamenti. Attraverso BoolBnB i proprietari di appartamento possono inserire le informazioni degli appartamenti che vogliono affittare per cercare utenti interessati. 
 
Gli utenti che vogliono mettere in affitto un appartamento devono registrarsi alla piattaforma; una volta registrati hanno la possibilità di inserire uno o più appartamenti. 
 
Gli utenti interessati ad un appartamento, utilizzando i filtri di una apposita pagina di ricerca, vedono una lista di possibili appartamenti e cliccando su ognuno possono vedere una pagina di dettaglio. Una volta trovato l’appartamento desiderato, l’utente interessato può contattare l’utente proprietario per fare domande. 
 
Inoltre, i proprietari di un appartamento possono decidere di pagare per sponsorizzare l’annuncio del proprio appartamento per fare in modo che il loro annuncio sia maggiormente in evidenza rispetto a quelli non sponsorizzati.

## Requisiti minimi
laPasticceria è basato sul framework Php **Laravel**. 

Composer 1.10.7  
PHP 7.2.5  
MySQL 10.4.11   
Node.js 13.12.0  


## Uso
Installa dapprima i moduli necessari:

```
composer install
```

```
npm install
```

Crea il file .env, seguendo l'esempio fornito da .env.example (si trova nella cartella root). Di particolare importanza i seguenti parametri:

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Lancia i seguenti comandi:
```
php artisan key:generate 
 ```

```
php artisan serve
 ```

```
npm run watch
 ```


Esegui le migrazioni e il seeding:

 ```
php artisan migrate:fresh --seed
 ```

# Anteprima
## Homepage
![](dev_miscellaneous/images_promo/home_page.png)




## Ricerca dell'appartamento
![](dev_miscellaneous/images_promo/ricerca.png)




## Mappa interattiva con i risultati della ricerca
![](dev_miscellaneous/images_promo/search_map.png)




## Popup per loggarsi
![](dev_miscellaneous/images_promo/login.png)




## L'utente registrato può consultare i messaggi ricevuti
![](dev_miscellaneous/images_promo/messaggi.png)




## L'utente registrato può sponsorizzare il suo appartamento
![](dev_miscellaneous/images_promo/pagamento.png)
