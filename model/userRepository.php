<?php


class userRepository extends Repository
{

    public function loginUsers($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $params = [
            ":username" => $username,
        ];

        return $this->db->selectOne($sql, $params);
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        return $this->db->select($sql);
    }

    public function getStudents()
    {
        $sql = "SELECT * FROM users WHERE role_id=1";
//        $params =
        return $this->db->select($sql);
    }

    public function searchUsers($str)
    {
        $sql = "SELECT users.*, role.id AS roles_id
            FROM roles
                INNER JOIN roles
                    ON users.roles_id = roles_id
                    WHERE user.name LIKE :search OR user.surname LIKE :search";

        $params = [
            ":search" => "%" . $str . "%"
        ];

        return $this->db->select($sql, $params);
    }

    public function addUser($username, $password, $name, $surname, $roleId)
    {
        $sql = "INSERT INTO users SET username= :username, password= :password, name = :name, surname= :surname, role_id = :roleId";
        $params = [
            ":username" => $username,
            ":password" => $password,
            ":name"=> $name,
            ":surname"=> $surname,
            ":roleId" => $roleId
        ];

        return $this->db->insert($sql, $params);
    }

    public function editUser($username, $password, $name, $surname, $id)
    {
        $sql = "UPDATE users SET id= :id, username= :username, password= :password, name = :name, surname= :surname";
        $params = [
            ":id"=>$id,
            ":username" => $username,
            ":password" => $password,
            ":name"=> $name,
            ":surname"=> $surname
        ];

        $this->db->update($sql, $params);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $this->db->delete($sql, [
            ":id" => $id,
        ]);
    }

//    public function getUsers($id)
//    {
//        $sql = "SELECT * FROM users WHERE id = :id";
//
//        return $this->db->selectOne($sql, [
//            ":id" => $id,
//        ]);
//    }

}