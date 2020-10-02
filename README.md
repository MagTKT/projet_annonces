# projet_annonces

Créer un site de petites annonces.Le site devra comprendre les fonctionnalités suivantes : 
- Page listant toutes les annonces disponibles. (Non loggé).
Pour chaque annonce, afficher uniquement le titre et le prix, ainsi qu’un lien permettant de voir le détail.
Si pas d’annonce, afficher «aucune d’annonce».
Afficher sur la page un lien pour se connecter/s’inscrire si l’utilisateur n’est pas connecté
- Page permettant de voir le détail d’une annonce. (Non loggé)
Afficher le titre, prix, description, photos s’il y en a et le login du créateur.Afficher un lien permettant de contacter le créateur.
- Page de login : (Non loggé)Afficher un lien pour revenir à la liste des annonces.
Retour au formulaire et affichage d’un message en cas d’erreur.Redirection sur le profil en cas de succès.

- Page d’inscription : (Non loggé) (Peut être sur la même page que le login)5 champs : login, password (encrypted), vérification de password, email, téléphone.Valider que password === vérification.
Valider que le password comprend au moins 1 chiffre, 1 lettre, 1 caractère spécial.
Valider le format de l’adresse email.
Valider le format du numéro de téléphone.
Enregistrer également la date de l’inscription en cas de succès.
Retour au formulaire et affichage d’un message en cas d’erreur. 
En cas de succès, rediriger l’utilisateur sur la page de son profil.
- Page profil : afficher les informations dont on dispose sur l’utilisateur : (loggé)
Login, email, tel, date d’inscription, photo de profil.
Afficher un lien permettant de modifier le profil.Afficher un lien permettant de créer une nouvelle annonce.

Afficher un lien permettant de créer des annonces en batch (upload zip).
Afficher un lien permettant de voir«Mes annonces»
- Page de modification de profil : (loggé)
 champs : Login, curent password, new password, vérification new password, tel, photo de profil.
 
 Les champs doivent être remplis par défaut avec les informations dont on dispose déjà (excepté les champs password et photo qui seront vides à l’arrivée sur la page)
 .En cas d’erreur, retour sur le formulaire avec le message d’erreur.
 En cas de succès, redirection sur le profil.
 Assurez-vous qu’un utilisateur ne puisse modifier le profil de quelqu’un d’autre.
 - Formulaire de création d’annonce (loggé)
  champs : titre, description, date de fin, prix, photo1, photo2, photo3.Valider le format de la date de fin.
Valider le format du prix.

En cas d’erreur, renvoyer sur le formulaire de création avec un message d’erreur.
En cas de succès, renvoyer sur le formulaire de création avec un message de succès.Enregistrer également la date de création et l’id du créateur.
- Page listant toutes les annonces d’un utilisateur. (Loggé).
Pour chaque annonce, afficher uniquement le titre, ainsi qu’un lien permettant de modifier l’annonce.
- Page permettant de modifier une annonce. (Loggé)
 champs : titre, description, date de fin, prix, photo1, photo2, photo3.Les champs doivent être préremplis.
 Ajouter des boutons (ou liens) permettant de supprimer une photo en particulier.Assurez-vous que seul le créateur d’une annonce puisse la modifier.
 - Page permettant d’envoyer un mail au créateur d’une annonce. (Loggé)
 Formulaire avec destinataire, et contenu du message.
 Le sujet sera automatiquement rempli avec «à propos de votre annonce + {titre de l’annonce}.- Formulaire permettant de créer un batch d’annonce par upload zip. (Loggé)
 Formulaire à un seul champ : 
 le zip.Le zip doit comprendre 1 csv, et autant d’images que l’on veut.Les zip suivra le format suivant : 
 Titre annonce; description annonce; 
 prix; date de fin; photo1; photo2; photo3.
 
 Attention : si une erreur survient lors de la création d’une annonce, aucune annonce ne devra être crééePour toutes les pages :
 
 Si l’utilisateur doit être loggé, le rediriger vers la page de login s’il n’est pas loggé.
 
 Afficher un lien vers l’accueil sur toutes les pages.Si l’utilisateur est connecté, afficher un lien pour se déconnecter sur toutes les pages. La déconnexion effectuée, l’utilisateur doit être redirigé sur la page d’accueil avec toutes les annonces.
 
 Si l’utilisateur n’est pas connecté, afficher un lien vers la page de connection / inscription sur toutes les pages.
 
 S’il est connecté, afficher un lien vers son profil à la placeNotation : Aucune attention ne sera portée au design. Assurez-vous seulement que le site soit utilisable (toutes les pages doivent être accessibles).Sera pris en compte dans la notation : 
 
 - Le bon fonctionnement des features demandées.- le niveau de validation des champs des formulaire.

- La gestion des erreurs/exception potentielles, et l’affichage de feedbacks pour l’utilisateur.- la qualité du code (un minimum : nomage des variables, organisation des fichiers)