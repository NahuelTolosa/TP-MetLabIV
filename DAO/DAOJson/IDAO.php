<?php namespace DAO\DAOJson;

interface IDAO{
    function GetAll();
    function Add($object);
    function Delete($idObject);
    function Update($object);
}