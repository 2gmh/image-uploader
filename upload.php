<?php
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    $nombre = $_POST["nombre"] ?? '';
    if ($nombre === '') {
        $nombre = rand(333333, 666666);
    }
    $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($extension, $allowed_extensions)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . $nombre . "." . $extension;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "<style>body{font-family: Arial, sans-serif; background-color: #E5E5E5;}</style>";
            echo "<div style=\"margin: 0 auto; width: 250px; text-align: center; animation: move 2s infinite;\"><a href=\"$target_file\" target=\"_blank\"><img src=\"$target_file\" width=\"250\" height=\"250\"></a><br>";
            echo "<button id=\"enlace\" style=\"margin-top: 20px; padding: 10px 20px; font-size: 16px; background-color: white; color: black; border: none; border-radius: 5px; transition: background-color 2s;\"><a href=\"$target_file\" target=\"_blank\" style=\"color: black; text-decoration: none;\">Go to </a></button></div>";
            header('Refresh: 4; URL=index.php'); // Redirecciona al usuario después de 4 segundos
            exit; // Detiene la ejecución del script
        } else {
            header('Location: index.html'); // Redirecciona al usuario a la página original
            exit; // Detiene la ejecución del script
        }
    } else {
        echo "Lo sentimos, solo se permiten archivos de imagen con las extensiones " . implode(', ', $allowed_extensions);
    }
} else {
    header('Location: index.html'); // Redirecciona al usuario a la página original
    exit; // Detiene la ejecución del script
}
?>

<style>
    @keyframes move {
        0% {transform: translateX(-10px);}
        50% {transform: translateX(10px);}
        100% {transform: translateX(-10px);}
    }
    
    #enlace:hover {
        background-color: black;
        color: white;
    }
</style>
