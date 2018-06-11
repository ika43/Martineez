<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 3/5/2018
 * Time: 1:31 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Survey
{
    //region data
    private $id;
    private $user_id;
    private $question;
    //endregion

    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function setQuestion($question){
        $this->question = $question;
    }
    //endregion

    public function getSurveyById()
    {
        return DB::table('survey-question')
            ->join('question','survey-question.question_id','=','question.id')
            ->where('survey-question.survey_id','=', $this->id)
            ->get();
    }

    public function getStatistic($id){
        return DB::select('SELECT q.question, q.id, AVG(answer) as avg FROM question q JOIN `survey-question` sq ON q.id = sq.question_id JOIN answer a ON a.question_id = q.id WHERE sq.survey_id = ? GROUP BY a.question_id',[$id]);
    }

    public function getNumUser($id, $answer){
        return DB::select('SELECT COUNT(user_id) as num FROM answer WHERE question_id = ? AND answer = ?',[$id, $answer]);
    }

    public function updateQuestion($text, $id){
        DB::table('question')
            ->where('id', $id)
            ->update(['question' => $text]);

    }

    public function insertSurvey($name){
        return DB::table('survey')
            ->insertGetId([
                'name' => $name,
            ]);
    }

    public function insertQuestion($q){
        return DB::table('question')
            ->insertGetId([
                'question' => $q,
            ]);
    }

    public function insertQuestionSurvey($id, $q1, $q2, $q3){
        return DB::table('survey-question')
            ->insert([[
                'survey_id' => $id,
                'question_id' => $q1,
            ],[
                'survey_id' => $id,
                'question_id' => $q2,
            ],[
                'survey_id' => $id,
                'question_id' => $q3,
            ]]);
    }

    public function deleteSurvey($id){
        DB::table('survey')
            ->where('id','=',$id)
            ->delete();
    }

    public function getSurveyShow(){
        return DB::table('survey-show')
            ->where('id','=',1)
            ->select('survey_id')
            ->first();
    }

    public function setSurveyActive($id){
        DB::table('survey-show')
            ->where('id','=',1)
            ->update(['survey_id'=> $id]);
    }


}