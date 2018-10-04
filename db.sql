/**
 * Author:  Ewerton
 * Created: 03/10/2018
 */

/* CREATE DATABASE database; */
CREATE TABLE usuarios(
    id SERIAL PRIMARY KEY,
    fname VARCHAR(45) NOT NULL,
    lname VARCHAR(45),
    email VARCHAR(60) NOT NULL,
    cell_phone VARCHAR(32) NOT NULL,
    home_phone VARCHAR(32) NOT NULL,
);