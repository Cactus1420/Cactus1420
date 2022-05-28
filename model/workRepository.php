<?php

class workRepository extends Repository
{
    public function getWorks()
    {
        $sql = "SELECT * FROM works";

        return $this->db->select($sql);
    }

    public function addWorks($date, $hours, $earnings, $expenses, $workCategoryId, $note)
    {
        $sql = "INSERT INTO works SET date= :date, hours= :hours, earnings = :earnings, expenses= :expenses, workCategory_id = :workCategory_id, note = :note";
        $params = [
            ":date" => $date/*->format(DateTime::ISO8601)*/,
            ":hours" => $hours,
            ":earnings" => $earnings,
            ":expenses"=> $expenses,
            ":workCategory_id"=> $workCategoryId,
            ":note"=> $note
        ];

        return $this->db->insert($sql, $params);
    }

    public function getCategories(){
        $sql = "SELECT * FROM work_categories";
        return $this->db->select($sql);
    }

    public function approveWorks()
    {

    }

}