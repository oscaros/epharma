<?php

namespace App\Traits;

trait AccessTrait
{
    public static $admin = [
        "Dashboard" => [
            "View Dashboard", "View Dashboard Cards", "View Dashboard Charts", "View Dashboard Tables",
            // "View Only Assigned",
        ]
    ];

  


    public static $staff = [
        "Module" => ['Staff Management'],
        "Staff" => ['View Staff', 'Edit Staff', 'Add Staff', 'Delete Staff', 'Assign Roles'],
    ];

    public static $reports = [
        "Module" => ['Report Management'],
        "Report" => ['View Report', 'Edit Report', 'Add Report', 'Delete Report'],

    ];

    public static $settings = [
        "Module" => ['Settings Management'],
        "Settings" => ['View Settings', 'Edit Settings', 'Add Settings', 'Delete Settings'],
    ];


    public static $logs = [
        "Module" => ['Log Management'],
        "Logs" => ['View Logs', 'Edit Logs', 'Add Logs', 'Delete Logs'],
    ];

    //roles
    public static $roles = [
        "Module" => ['Role Management'],
        "Role" => ['View Roles', 'Edit Roles', 'Add Roles', 'Delete Roles'],
    ];

  
    //entity
    public static $entities = [
        "Module" => ['Entities Management'],
        "Entities" => ['View Entities', 'Edit Entities', 'Add Entities', 'Delete Entities'],
    ];

    //products
    public static $products = [
        "Module" => ['Products Management'],
        "Products" => ['View Products', 'Edit Products', 'Add Products', 'Delete Products'],
    ];

    //sales
    public static $sales = [
        "Module" => ['Sales Management'],
        "Sales" => ['View Sales', 'Edit Sales', 'Add Sales', 'Delete Sales'],
    ];





    public static function spreadArrayKeys($assocArray)
    {
        $result = [];
        foreach ($assocArray as $key => $value) {
            if (is_string($key)) {
                $result[] = $key;
            }
            if (is_array($value)) {

                $result = array_merge($result, static::spreadArrayKeys($value));
            } else {
                $result[] = $value;
            }
        }
        return  $result;
    }

    public static function getAllPermissions()
    {
        $roles = static::spreadArrayKeys(
            array_merge(
                static::$admin,
   
                static::$reports,
          
                static::$staff,
                static::$settings,
                static::$logs,
                static::$roles,
         
                static::$entities,
                static::$products,
                static::$sales




            )
        );
        return $roles;
    }
    public static function getAccessControl()
    {

        $access = [
            "Dashboard" => self::$admin,

            "Staff" => self::$staff,
            "Reports" =>  self::$reports,
            "Settings" => self::$settings,
            "Logs" => self::$logs,
            "Roles" => self::$roles,

            "Entities" => self::$entities,
            "Sales" => static::$sales,
            "Products" => static::$products,



            // "Accounting" => static::$accounting
        ];
        return $access;
    }


    /**
     * Check if the user has specific role permission.
     *
     * @param datatype $pageRole description of page role
     * @param datatype $actions description of actions
     * @return boolean
     */
    public static function userCan($pageRole, $permissions)
    {
        $permissions =  json_decode($permissions);
        return in_array($pageRole, $permissions);
    }

    public static function user_can($page_role)
    {
        $actions1 = $_SESSION['actions'];
        $actions = json_decode($actions1);
        // print_r($actions);
        return in_array($page_role, $actions);
    }
    public static function is_assoc(array $array)
    {
        // Keys of the array
        $keys = array_keys($array);
        // If the array keys of the keys match the keys, then the array must
        // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
        return array_keys($keys) !== $keys;
    }
}
