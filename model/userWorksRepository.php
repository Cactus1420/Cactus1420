<?php

class userWorksRepository extends Repository
{

    public function userWorks($workId, $userId)
    {
        $sql = "INSERT INTO user_works SET user_id= :userId, work_id= :workId";
        $params = [
            ":user_id" => $userId,
            ":work_id" => $workId
        ];
        return $this->db->insert($sql, $params);
    }

    public function addUserWorks($worker, $work)
    {
        $sql = "INSERT INTO user_works SET user_id= :worker, work_id= :work";
        $params = [
            ":worker" => $worker,
            ":work" => $work
        ];
        return $this->db->insert($sql, $params);
    }
}