## CO-PO-PSO Accreditation webapp details

Every dependencies used during development will be updated here.I kindly request every one to visit this website frequently.

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

1. Routes:
   * ~~Current routes utilize the user_course_id, which will be visible to user. This seems like bad design, but more in-depth understanding of sessions might be needed to verify this.~~ Middlewares can be used to limit access. 
   * Modify controllers so that only the user to which the user_course_code belongs has access to the pages utilizing them in the routes
   * Enhance readability of the routes (Currently, mixed up while fixing other bugs)
   
2. Controllers:
   * ~~CoController - big and bloated - split into other controllers specific to each action.~~. Done.  
      CoController split into: Co (for CO defintiion), CoPoPso (for COPOPSO matrix), Justifications, & Weightages controller.
   * ~~Function names to be changed to more readable ones.~~ Done. 
      Function names now utilize RESTful conventions. 
   * Server side validation not completed. Validation present currently in only 2-3 functions. Complete the rest + Diagnose problems with redirect. 
   * Prevent duplicate form submission.
   
3. Views:
   * The status of each user_course determines what's shown on this page. Current setup is such that, for the given values of $status:
   ```
      0 -> No steps completed. Link to CO Form. 
      1 -> COs have been defined. Display them. Link to CO-PO Matrix form. 
      2-17 -> CO-PO Matrix defined. Display matrix. Link to ($status-1)th PO Justification form.
      18 -> All PO's and PSO's justified. Link to CO Weightage form.
      19 -> Weightages filled. Link to Upload page. 
      20 -> Upload completed.
   ```
   * ~~There are minor bugs in this page, but more time can be spent on that after confirming that we're going ahead with this way of keeping account of the status.~~ A status table will be created for keeping track of this. 
   * Client-side verifications (calculating total weightages, etc)
4. Database:
   * Check if string lengths are compatible with requirements of each field
   * Check if fields have been assigned the correct data types (ie, int vs smallint etc)
   * Assign composite primary keys in some of the tables needing them
   * PSOs are different for each branch - devise method to store and access them. 
   * Store academic_year in user course as string? Using date formats not possible since two years are concatenated. Temporarily being stored as an integer.
 
Choose an area to work on and inform the rest.
 
## DATABASE SCHEMA

![Current](https://ibb.co/n0mxja)

![Modified](https://ibb.co/foRKxv)

## Coming Up Soon
 
 Site Map
   
### Support or Contact

Having trouble with Installing or any doubt..?
Ask on our whatsapp group.

With 
Love
### CO-PO-PSO Team
