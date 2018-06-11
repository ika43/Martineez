<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class User
{


    //region data
    private $id;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $workplace;
    private $position;
    private $city;
    private $state;
    private $dateOfBirth;
    private $role_id;
    //endregion

    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getFirstname(){
        return $this->firstname;
    }

    public function getRole_id(){
        return $this->role_id;
    }

    public function setRole_id($roleId){
        $this->role_id = $roleId;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getWorkplace(){
        return $this->workplace;
    }

    public function setWorkplace($workplace){
        $this->workplace = $workplace;
    }

    public function getPosition(){
        return $this->position;
    }

    public function setPosition($position){
        $this->position = $position;
    }

    public function getCity(){
        return $this->city;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function getState(){
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
    }

    public function getDateOfBirth(){
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth){
        $this->dateOfBirth = $dateOfBirth;
    }
    //endregion

    public function checkMail($mail)
    {
        return DB::table('user')
                ->where('email',$mail)
                ->first();
    }

    public function getAllUsers(){
        return DB::table('user')
            ->where('role_id','=',2)
            ->get();
    }

    public function newUser()
    {

        return DB::table('user')->insertGetId(
            [ 'firstname' => $this->firstname,
              'lastname' => $this->lastname,
              'password' => $this->password,
              'email' => $this->email,
              'workplace' => $this->workplace,
              'position' => $this->position,
              'role_id' => 2,
                ]
        );
    }

    public function login(User $user)
    {
        return  DB::table('user')
            ->where('password', '=', $user->getPassword())
            ->where('email','=',$user->getEmail())
            ->first();
    }

    public function getUserById($id){
        return DB::table('user')
            ->where('id',$id)
            ->first();
    }

    public function editUser($id)
    {
        if($this->state=="" && $this->city=="") {
            DB::table('user')
                ->where('id', $id)
                ->update([
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'workplace' => $this->workplace,
                    'position' => $this->position
                ]);
        }
        else if($this->dateOfBirth==""){
            DB::table('user')
                ->where('id', $id)
                ->update([
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'workplace' => $this->workplace,
                    'position' => $this->position,
                    'city' => $this->city,
                    'state' => $this->state,
                ]);
        }else{
            DB::table('user')
                ->where('id', $id)
                ->update([
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'workplace' => $this->workplace,
                    'position' => $this->position,
                    'city' => $this->city,
                    'state' => $this->state,
                    'dateOfBirth' => $this->dateOfBirth
                ]);
        }
    }

    public function regUser(){
        DB::table('user')
            ->insert([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'workplace' => $this->workplace,
                'position' => $this->position,
                'city' => $this->city,
                'state' => $this->state,
                'dateOfBirth' => $this->dateOfBirth,
                'password' => $this->password,
                'email' => $this->email,
                'role_id' => 2,
            ]);
    }

}
