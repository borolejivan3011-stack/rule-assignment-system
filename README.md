# Rule Assignment System

This project is developed in Core PHP using object oriented approach.
The objective of this assignment is to create and manage hierarchical rule assignments inside groups. A group can have multiple rules and rules can be linked using parent-child relationships up to 3 levels.

## Technology Used
  PHP 8
  MySQL
  jQuery
  AJAX
  Bootstrap 5

## Modules Covered
  Create Group
  Assign Rules
  View Groups
  Edit Group
  Hierarchy View
  Tier Validation

## Folder Structure
rule_assignment/
app/
    api/
    controllers/
    services/
    models/
    core/
    database/
    views/

public/

index.php
README.md


## Database Tables

### groups
Stores group details.

### rules
Stores master rules used in the system.

### group_rules
Stores assigned rules and hierarchy information.

## ER Diagram
ER diagram file is available inside:
app/database/ERD.docx


## Validations Implemented

  Maximum 3 tiers allowed
  Duplicate rule under same parent is not allowed
  Parent child hierarchy maintained using parent_rule_id
  Rules are displayed in assigned order

## Application Flow
For create/update operations:
API -> Controller -> Service -> Model -> Database


For simple listing operations:


API -> Model -> Database


## Running the Project

1. Import schema.sql file from database folder.
2. Copy project inside htdocs folder.
3. Start Apache and MySQL from XAMPP.
4. Open below URL.


http://localhost/rule_assignment/


## Notes

  This project is developed without using any PHP framework.
  jQuery is used for AJAX requests and UI interactions.
  Bootstrap is used only for basic UI design.
  Controller and Service layers are used for business operations like create and update.
