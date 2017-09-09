## CO-PO-PSO Accreditation webapp details

Every dependencies used during development will be updated here. I kindly request every one to visit this website frequently.

## To Install this project

```
   git clone https://github.com/shasin999-gcek/copopso.git
   
   cd copopso
   
   composer install
   
   cp .env.example .env
   
   php artisan key:generate
   
   php artisan migrate
   
   php artisan db:seed
   
   php artisan serve
```

Login as "abc@xyz.com" with password "12345". Two courses have already been associated with this user .

## Areas to Work on

   
The status of each user_course determines what's shown on this page. Current setup is such that, for the given values of $status:
   ```
      0 -> No steps completed. Link to CO Form. 
      1 -> COs have been defined. Display them. Link to CO-PO Matrix form. 
      2-17 -> CO-PO Matrix defined. Display matrix. Link to ($status-1)th PO Justification form.
      18 -> All PO's and PSO's justified. Link to CO Weightage form.
      19 -> Weightages filled. Link to Upload page. 
      20 -> Upload completed.
   ```
 
Database:
   * Check if string lengths are compatible with requirements of each field
   * Check if fields have been assigned the correct data types (ie, int vs smallint etc)
   * Assign composite primary keys in some of the tables needing them
   * PSOs are different for each branch - devise method to store and access them. 
   * Store academic_year in user course as string? Using date formats not possible since two years are concatenated. Temporarily being stored as an integer.
 
## DATABASE SCHEMA

![Current](https://image.ibb.co/jvaq4a/current_db.png)

![Modified](https://image.ibb.co/d88oqF/modified_db.png)

   
### Support or Contact

Having trouble with Installing or any doubt..?
Ask on our whatsapp group.

With 
Love
### CO-PO-PSO Team
