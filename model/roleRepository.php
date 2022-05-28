<?php


class roleRepository extends Repository
{
    public function getRoles()
    {
        $sql = "SELECT * FROM roles";

        return $this->db->select($sql);
    }
}