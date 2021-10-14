<?php
namespace DAO;

interface IDAO{
    function GetAll();
    function Add($object);
    function Delete($object);
    function Update($object);
}