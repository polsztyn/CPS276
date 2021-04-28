create database final_project;

create table contacts
(
    contact_name char(250),
    street_address char(250),
    city char(100),
    state char (30),
    phone char (30),
    email char (250),
    birth_date char (50),
    contact_types char (100),
    age_range (20)
);