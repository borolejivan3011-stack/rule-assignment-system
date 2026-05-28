# Rule Assignment System

This project is developed using object-oriented Core PHP and MySQLi.
The purpose of this assignment is to manage hierarchical rule assignments inside groups with tier based validation.

---

## Technologies Used

PHP 8
MySQL / MySQLi
 jQuery
Bootstrap 5
AJAX

---

## Features

Create Group
Assign Rules
Parent Child Rule Structure
Maximum 3 Tier Validation
View Saved Groups
Edit Existing Groups
Hierarchical Rule Display

---

## Project Structure

rule_assignment/ 
api/ 

app/ 
	controllers/ 
	services/ 
	models/ 
	core/ 
	
database/ 
layout/ 
public/ 

index.php 
groups.php 
edit-group.php 
README.md

---

## Database Tables
# groups

Stores group information.
# rules
Stores predefined rules.
# group_rules
Stores hierarchical parent-child rule assignments.

## ER Diagram
Simple ER diagram is added inside the database folder for reference.
File: database/ERD.docx


## Validation Rules
 Maximum 3 tiers allowed
 Duplicate rules under same parent are restricted
 Rules are assigned using parent-child relationship
 Rules can be reused in different hierarchy levels

---

## Pages

# index.php
Used to create new groups and assign rules.

# groups.php
Displays saved groups with hierarchy structure.

# edit-group.php
Used to update existing group assignments.

---

## Run Project

1. Import database/schema.sql
2. Place project inside xampp/htdocs/
3. Start Apache and MySQL
4. Open below URL
http://localhost/rule_assignment/


---

## Notes

 Backend logic is implemented using object-oriented PHP structure.
 jQuery AJAX is used for frontend interaction.
 Bootstrap is used only for UI styling.
 No third-party backend framework is used in this project.
