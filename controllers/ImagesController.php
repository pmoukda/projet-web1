<?php
namespace App\Controllers;

use App\Models\Images;
use App\Models\Timbre;
use App\Providers\Auth;
use App\Providers\View;
use App\Providers\Validator;

class ImagesController{
    public function __construct(){
        Auth::session();
    }
    
    public function index(){
        $image = new Images;
        $images = $image->selectbyTimbreId();
        
        return View::render('images/index', ['images' => $images]);
        
    }
    
    public function create(){
        if (isset($_SESSION['timbre_id'])) {
            $timbreId = $_SESSION['timbre_id'];
            
        } else {
            $timbreId = null;
        }
        $timbre = new Timbre;
        $timbres = $timbre->select();
        
        return View::render('images/create', ['timbre_id' => $timbreId, 'timbres' => $timbres ]);
        
    }
    
    // public function store($data) {
    //     $validator = new Validator;
        
    //     $validator->field('image_principale', $data['image_principale'], "l'image principale")->yesNo();
    //     $validator->field('timbre_id', $data['timbre_id'], "l'id du timbre")->int();
        
    //     if (!isset($_FILES['liens_images']) || !isset($_FILES['liens_images']['name'][0])) {
    //         return View::render('errors', ['message' => "Veuillez téléverser au moins une image."]);
    //     }
        
    //     if ($validator->isSuccess()) {
    //         $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    //         $uploadDir = dirname(__DIR__) . '/public/img/';
    //         $image = new Images;
            
    //         $maxSize = 3 * 1024 * 1024; // 3 Mo
    //         $maxWidth = 800;
    //         $maxHeight = 800;
            
    //         // Boucle sur les fichiers envoyés
    //         foreach ($_FILES['liens_images']['name'] as $index => $name) {
    //             if ($_FILES['liens_images']['error'][$index] !== 0) {
    //                 continue; // ignore le fichier en erreur
    //             }
                
    //             // Vérification du poids
    //             if ($_FILES['liens_images']['size'][$index] > $maxSize) 
    //                 continue;// ignorer si le poid exède
                
    //             $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    //             if (!in_array($extension, $allowed)) {
    //                 continue; // ignore les extensions non valides
    //             }
                
    //             // Vérification des dimensions de l'image
    //             $tmpFilePath = $_FILES['liens_images']['tmp_name'][$index];
    //             $dimensions = getimagesize($tmpFilePath);
                
    //             if (!$dimensions) {
    //                 continue; // Ce n’est pas une vraie image
    //             }
                
    //             $largeur = $dimensions[0];
    //             $hauteur = $dimensions[1];
                
    //             // Limite max 
    //             if ($largeur > $maxWidth || $hauteur > $maxHeight) {
    //                 continue; // image trop grande
    //             }
                
    //             // Générer un nom de fichier unique
    //             $nomFichierOriginal = pathinfo($name, PATHINFO_FILENAME);
    //             $nomNettoye = preg_replace('/\s+/', '-', strtolower($nomFichierOriginal));
    //             $timestamp = time();
    //             $liensImages = $nomNettoye . '-' . $timestamp . '-' . $index . '.' . $extension;
                
    //             $uploadPath = $uploadDir . $liensImages;
                
    //             if (move_uploaded_file($tmpFilePath, $uploadPath)) {
    //                 $data['liens_images'] = $liensImages;
    //                 $insertImages = $image->insert($data);
                    
    //                 if ($insertImages) {
    //                     return View::redirect('images');
    //                 } else {
    //                     return View::render('errors', ['message' => "Une ou plusieurs images n'ont pas pu être enregistrées."]);
    //                 }
                    
    //             }
    //         }
            
    //     } else {
    //         $errors = $validator->getErrors();
    //         $timbre = new Timbre;
    //         $timbreId = $timbre->selectId($data['timbre_id']);
            
    //         return View::render('images/create', ['errors' => $errors, 'images' => $data, 'timbres' => $timbreId]);
    //     }
    // }
    
    public function store($data) {
    $errors = [];

    $validator = new Validator;
    $validator->field('image_principale', $data['image_principale'], "l'image principale")->yesNo();
    $validator->field('timbre_id', $data['timbre_id'], "l'id du timbre")->int();

    if (!$validator->isSuccess()) {
        $errors = array_merge($errors, $validator->getErrors());
    }

    if (!isset($_FILES['liens_images']) || !isset($_FILES['liens_images']['name'][0])) {
        $errors[] = "Veuillez téléverser au moins une image.";
    }

    if (!empty($errors)) {
        $timbre = new Timbre;
        $timbreId = $timbre->selectId($data['timbre_id']);
        return View::render('images/create', [
            'errors' => $errors,
            'images' => $data,
            'timbres' => $timbreId
        ]);
    }

    // Si validation OK, on continue
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $uploadDir = dirname(__DIR__) . '/public/img/';
    $image = new Images;
    $maxSize = 3 * 1024 * 1024;
    $maxWidth = 800;
    $maxHeight = 800;

    foreach ($_FILES['liens_images']['name'] as $index => $name) {
        if ($_FILES['liens_images']['error'][$index] !== 0) continue;
        if ($_FILES['liens_images']['size'][$index] > $maxSize) continue;

        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowed)) continue;

        $tmpFilePath = $_FILES['liens_images']['tmp_name'][$index];
        $dimensions = getimagesize($tmpFilePath);
        if (!$dimensions) continue;

        [$largeur, $hauteur] = $dimensions;
        if ($largeur > $maxWidth || $hauteur > $maxHeight) continue;

        $nomFichierOriginal = pathinfo($name, PATHINFO_FILENAME);
        $nomNettoye = preg_replace('/\s+/', '-', strtolower($nomFichierOriginal));
        $timestamp = time();
        $liensImages = $nomNettoye . '-' . $timestamp . '-' . $index . '.' . $extension;
        $uploadPath = $uploadDir . $liensImages;

        if (move_uploaded_file($tmpFilePath, $uploadPath)) {
            $data['liens_images'] = $liensImages;
            $insertImages = $image->insert($data);

            if (!$insertImages) {
                $errors[] = "Une erreur est survenue lors de l'insertion de l'image.";
            }
        } else {
            $errors[] = "Erreur lors du déplacement de l'image téléchargée.";
        }
    }

    if (!empty($errors)) {
        $timbre = new Timbre;
        $timbreId = $timbre->selectId($data['timbre_id']);
        return View::render('images/create', [
            'errors' => $errors,
            'images' => $data,
            'timbres' => $timbreId
        ]);
    }

    return View::redirect('images');
}

    public function view($data){
        // print_r($data);die();
        if(isset($data['id']) && $data['id'] != null){
            $image = new Images;
            $selectedId = $image->selectId($data['id']);
            
            if($selectedId){
                $timbre_id = $selectedId['timbre_id'];
                $timbre = new Timbre;
                $selectTimbre = $timbre->selectId($timbre_id);
                
                
                return View::render('images/view', ['images' => $selectedId, 'timbre' => $selectTimbre]);
            }else{
                return View::render('errors',['message' => 'Image non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' =>'Erreur 404']);
        }
    }
    
    public function edit($data){
        if(isset($data['id'])&& $data['id'] != null){
            $image = new Images;
            $selectedId = $image->selectId($data['id']);
            
            if($selectedId){
                $timbre_id = $selectedId['timbre_id'];
                $timbre = new Timbre;
                $selectTimbre = $timbre->selectId($timbre_id);
                // print_r($selectTimbre);
                // die();
                
                return View::render('images/edit', ['images' => $selectedId, 'timbre' => $selectTimbre]);
            }else{
                return View::render('errors',['message' => 'Image non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' =>'Erreur 404']);
        }
    }
    
    public function update($data, $get){
        if(isset($get['id']) && $get['id'] != null){
            $validator = new Validator;
            if (isset($data['timbre_id']) && is_numeric($data['timbre_id'])) {
                $validator->field('timbre_id', $data['timbre_id'], "l'id du timbre")->int();
            } else {
                return View::render('errors', ['message' => "L'ID du timbre est invalide."]);
            }
            
            $validator->field('image_principale', $data['image_principale'], "l'image principale")->yesNo();
            $validator->field('timbre_id', $data['timbre_id'], "l'id du timbre")->int();
            
            if ($validator->isSuccess()) {
                $image = new Images;
                $existingImage = $image->selectId($data['id']);
                
                if (!$existingImage) {
                    return View::render('errors', ['message' => "Image non trouvée."]);
                }
                
                $uploadDir = dirname(__DIR__) . '/public/img/';
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                $maxSize = 3 * 1024 * 1024;
                $maxWidth = 800;
                $maxHeight = 800;
                
                $newImageUploaded = isset($_FILES['liens_images']) && $_FILES['liens_images']['error'] === 0;
                
                if ($newImageUploaded) {
                    if ($_FILES['liens_images']['size'] > $maxSize) {
                        return View::render('errors', ['message' => "Image trop lourde (max 3 Mo)."]);
                    }
                    
                    $extension = strtolower(pathinfo($_FILES['liens_images']['name'], PATHINFO_EXTENSION));
                    if (!in_array($extension, $allowed)) {
                        return View::render('errors', ['message' => "Extension non autorisée."]);
                    }
                    
                    $tmpFilePath = $_FILES['liens_images']['tmp_name'];
                    $dimensions = getimagesize($tmpFilePath);
                    if (!$dimensions) {
                        return View::render('errors', ['message' => "Fichier non reconnu comme une image."]);
                    }
                    
                    $largeur = $dimensions[0];
                    $hauteur = $dimensions[1];
                    
                    if ($largeur > $maxWidth || $hauteur > $maxHeight) {
                        return View::render('errors', ['message' => "Dimensions trop grandes (max 800x800)."]);
                    }
                    
                    $nomFichierOriginal = pathinfo($_FILES['liens_images']['name'], PATHINFO_FILENAME);
                    $nomNettoye = preg_replace('/\s+/', '-', strtolower($nomFichierOriginal));
                    $timestamp = time();
                    $liensImages = $nomNettoye . '-' . $timestamp . '.' . $extension;
                    $uploadPath = $uploadDir . $liensImages;
                    
                    if (move_uploaded_file($tmpFilePath, $uploadPath)) {
                        $ancienFichier = $uploadDir . $existingImage['liens_images'];
                        if (file_exists($ancienFichier)) {
                            unlink($ancienFichier);
                        }
                        
                        $data['liens_images'] = $liensImages;
                    } else {
                        return View::render('errors', ['message' => "Échec du téléchargement de l'image."]);
                    }
                } else {
                    // Pas de nouveau fichier,on garde l'ancien
                    $data['liens_images'] = $existingImage['liens_images'];
                }
                
                $updated = $image->update($data,$get['id']);
                
                if ($updated) {
                    return View::redirect('images/view?id=' . $data['id']);
                } else {
                    return View::render('errors', ['message' => "Erreur lors de la mise à jour."]);
                }
                
            } else {
                $errors = $validator->getErrors();
                $timbre = new Timbre;
                $selectTimbre = $timbre->selectId($data['timbre_id']);
                return View::render('images/edit', ['errors' => $errors, 'images' => $data, 'timbre' =>$selectTimbre]);
            } 
        }else{
            return View::render('errors', ['message' => 'Erreur 404']);
        }
    }
    
    public function delete($data){
        if(Auth::session()){
            $images = new Images;
            $deleted = $images->delete($data['id']);
            
            if ($deleted) {
                return View::redirect('images');
            }else{
                return View::render('errors', ['message' => 'Impossible de faire la suppression.']);
            }
        }
    }
    
    
    
}
?>
