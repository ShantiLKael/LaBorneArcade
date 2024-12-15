<?php

namespace Config;

use App\Models\ImageModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\Entity\Entity;
use CodeIgniter\HTTP\Files\UploadedFile;

class ImageUploader extends BaseService
{
    private ImageModel $imageModel;

    public function __construct()
	{
        $this->imageModel = new ImageModel();
    }
    
	public function enregistrerImage(UploadedFile $file, string $chemin): int {

		// Valider l'extension de l'image
		$allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
		$imageExtension = $file->getClientExtension();
		if (!in_array($imageExtension, $allowedExtensions)) {
			return 0;
		}

		// Renommer le fichier avec un nom unique
		$imageName = $file->getRandomName();

		// Déplacer le fichier vers le dossier
		$imagePath = $chemin.$imageName;
		$file->move(FCPATH . $chemin, $imageName);

		// Ajouter une entrée dans la table image
		$imageData = ['chemin' => $imagePath];
		return $this->imageModel->insert($imageData);
	}
}