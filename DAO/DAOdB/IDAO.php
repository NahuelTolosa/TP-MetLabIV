<?php
namespace DAO\DAOdB;

interface IDAO{
    function GetAll();
    function Add($object);
    function Delete($idObject);
    function Update($object);
}