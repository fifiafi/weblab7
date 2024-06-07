<?php
class weblab7 {
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
        $p = weblab7::connect()->prepare('SELECT * FROM weblab7Table');
        $p->execute();
        $data=$p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function delete($matric) {
        $p = weblab7::connect()->prepare('DELETE FROM weblab7Table WHERE matric = :matric');
        $p->bindValue(':matric', $matric);
        $p->execute();
}
public static function update($matric, $name, $password, $role) {
    $p = weblab7::connect()->prepare('UPDATE weblab7Table SET matric=:m, name=:n, password=:p, role=:r');
                $p->bindValue(':m', $matric);
                $p->bindValue(':n', $name);
                $p->bindValue(':p', $password);
                $p->bindValue(':r', $role);
                $p->execute();
}
}
?>