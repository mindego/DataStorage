# DataStorage
Small library for key-value data storage

While a big enough software usually uses database of some sorts, it will be overkill for smaller ones.
For this - here is small library that provides key-value storage without reliyng on any database. It needed only php and RW access right to its data directory

This library provides several classes for this. There are a few "Backing Storage" classes,  which are doing just that - reading and writing data as it is.

## DataStorage classes
Every data storage classes provides a CRUD access using a standart methods:
Create($key,$data)
Read($key)
Update($key,$data)
Delete(key)

If method fails for some reasons (for example - Create method is trying to create already existing record) it return false, else it return string $data (Read) or true (all other methods)

## Configuration
Every DataStorage classes is configured using config files. That is just simple key-value files in "key=value" formats. Examples are includedina "config" dir.

## DataStorageStacking class
DataStorageStacking class provides a way to store data in a some processed way. For example, data may be base64'd or gzipped or base64 AND gzipped (or vice versa).
Data processing pipeling is fully transparent.
