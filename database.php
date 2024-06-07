<?php
class weblab7Table {
    public static function connect() {
        try {
            $con = new PDO('mysql:host=localhost;dbname=weblab7', 'root', '');
            return $con;
        } catch (PDOException $error1) {
            echo 'Something went wrong, it was not possible to connect to the database! ' . $error1->getMessage();
        } catch (Exception $error2) {
            echo 'Generic error! ' . $error2->getMessage();
        }
    }
    public static function Selectdata() {
        $data=array();
        $p = weblab7Table::connect()->prepare('SELECT * FROM weblab7Table');
        $p->execute();
        $data=$p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function delete($matric) {
        $p = weblab7Table::connect()->prepare('DELETE FROM weblab7Table WHERE matric = :matric');
        $p->bindValue(':matric', $matric);
        $p->execute();
}
    public function update($matric, $name, $password, $role) {
        $p = weblab7Table::connect()->prepare('UPDATE weblab7Table SET name = :name, password = :password, role = :role WHERE matric = :matric');
        $p->bindValue(':name', $name);
        $p->bindValue(':password', $password);
        $p->bindValue(':role', $role);
        $p->bindValue(':matric', $matric);
        $p->execute();
}

}

?>