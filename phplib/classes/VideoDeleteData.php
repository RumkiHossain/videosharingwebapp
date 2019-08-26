<?php
class VideoDeleteData {


    public function __construct() {
        
    }

    public function deleteDetails($con, $videoId) {

        $query = $con->prepare("SELECT * FROM videos WHERE id=:videoId");
        
        $query->bindParam(":videoId", $videoId);

        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            
        $filePath = $row["filePath"];

        unlink($filePath);
        }

        $query2 = $con->prepare("SELECT * FROM thumbnails WHERE videoId=:videoId");
        
        $query2->bindParam(":videoId", $videoId);

        $query2->execute();

        while($row = $query2->fetch(PDO::FETCH_ASSOC)) {
            
        unlink($row["filePath"]);
            
        }


        $query1 = $con->prepare("DELETE FROM videos WHERE id=:videoId");
        
        $query1->bindParam(":videoId", $videoId);

        $query1->execute();

        $query3 = $con->prepare("DELETE FROM thumbnails WHERE videoId=:videoId");
        
        $query3->bindParam(":videoId", $videoId);

        $query3->execute();

        $query4 = $con->prepare("DELETE FROM likes WHERE videoId=:videoId");
        
        $query4->bindParam(":videoId", $videoId);

        $query4->execute();

        $query5 = $con->prepare("DELETE FROM dislikes WHERE videoId=:videoId");
        
        $query5->bindParam(":videoId", $videoId);

        $query5->execute();

        $query6 = $con->prepare("DELETE FROM comments WHERE videoId=:videoId");
        
        $query6->bindParam(":videoId", $videoId);

        $query6->execute();

        return true;
     
        }

        
    
}
?>
