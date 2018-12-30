<?php

namespace KS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\DateTime;

use KS\BlogBundle\Event\BlogEvent;
use KS\BlogBundle\Event\MessagePostEvent;

use KS\BlogBundle\Event\ContactEvent;
use KS\BlogBundle\Event\ContactPostEvent;

use KS\BlogBundle\Entity\Actu;
use KS\BlogBundle\Form\ActuType;


use KS\BlogBundle\Entity\Books;
use KS\BlogBundle\Form\BooksType;

use KS\BlogBundle\Entity\Category;
use KS\BlogBundle\Form\CategoryType;

use KS\BlogBundle\Entity\Sagas;
use KS\BlogBundle\Form\SagasType;

use KS\BlogBundle\Entity\Novels;
use KS\BlogBundle\Form\NovelsType;

use KS\BlogBundle\Entity\Images;
use KS\BlogBundle\Form\ImagesType;

use KS\BlogBundle\Entity\Guestbook;
use KS\BlogBundle\Form\GuestbookType;

use KS\BlogBundle\Entity\Chroniques;
use KS\BlogBundle\Form\ChroniquesType;

use KS\BlogBundle\Entity\Partenariats;
use KS\BlogBundle\Form\PartenariatsType;

use KS\BlogBundle\Entity\Interviews;
use KS\BlogBundle\Form\InterviewsType;



class KFarallController extends Controller
{

    /* page d'accueil */
    public function indexAction()
    {
        return $this->render('@KSBlog/KFarall/index.html.twig');
    }

    /// FORMULAIRE DE CONTACT
    public function contactAction(Request $request)
    {
       
        $email = $request->request->get('email');
        $title = $request->request->get('title');
        $message = $request->request->get('content');

            // ENVOI D'UN EMAIL A L'AUTEUR
            // préparation de l'évènement
            $event = new ContactPostEvent($email, $title, $message);
           
            // On déclenche l'évènement
            $this->get('event_dispatcher')->dispatch(ContactEvent::POST_CONTACT, $event);

        return $this->redirectToRoute('ks_blog_homepage');
    }

    /* menu déroulant */
    public function navbarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Category');
        $category = $rep->findAll();

        return $this->render('@KSBlog/KFarall/navbar.html.twig', ['category' => $category]);
    }

/*************************************************************************************************/
/* *********************************** SECTION PUBLICATIONS  *********************************** */
/*************************************************************************************************/

// affichage de la liste des publications sans sélectionner une catégorie particulière
    public function listePublicationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Books');
        $books = $rep->findAll();

        return $this->render('@KSBlog/KFarall/listePublications.html.twig', ['books' => $books]);
    }

// affichage des publications en fonction de la catégorie (SF, fantastique etc...)
    public function publicationsCategoryAction($category)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Books');
        $books = $rep->findBy(array('category' => $category));

        return $this->render('@KSBlog/KFarall/listePublications.html.twig', ['books' => $books]);
    }

// affichage du détail d'une seule publication
    public function publicationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Books');
        $book = $rep->find($id);

        return $this->render('@KSBlog/KFarall/publication.html.twig', ['book' => $book]);
    }


/*************************************************************************************************/
/* ******************************** AJOUT DE LIVRES DANS LA DB  ******************************** */
/*************************************************************************************************/

// 3 étapes pour ajouter une publication dans la base de données : 
// étape 1 : choix de la catégorie (commun avec l'ajout de nouvelles)
// étape 2 : choix de la saga
// étape 3 : ajout du livre


// ajout d'un livre ou d'une nouvelle, étape 1
    public function addcategoryAction(Request $request)
    {
        //création d'une catégorie à partir de lajout d'un livre / nouvelle
        // 1ERE ETAPE DE L'AJOUT de PUBLICATIONS & de NOUVELLES
        $session = $request->getSession();
        // creation d'une nouvelle catégorie si désiré
        $category = new Category();
        $form1 = $this->get('form.factory')->create(CategoryType::class, $category);

        // choix d'une catégorie existante
        $form2 = $this->createFormBuilder()
        ->add('category', EntityType::class, array('class'          => 'KSBlogBundle:Category',
                                                   'choice_label'   => 'name',
                                                   'multiple'       => false))
        ->getForm();

    //////////////////////////////////////////////////////////////////////////////////////////////////
        // si on ajoute une nouvelle catégorie (form1)
        if ($request->isMethod('POST') && ($form1->handleRequest($request)->isValid())) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            // ajout dans la session
            $categoryId = array('categoryId' =>$category->getId());

            // dans le cas de l'ajout d'un livre
            if ($session->has('newBook')) {
                $newBook = $session->get('newBook');
                array_push($newBook, $categoryId);
                $session->set('newBook', $newBook);
                return $this->redirectToRoute('ks_blog_admin_addsaga');
            }

            //dans le cas de l'ajout d'une nouvelle    
            if ($session->has('newNovel')) {
                $newNovel = $session->get('newNovel');
                array_push($newNovel, $categoryId);
                $session->set('newNovel', $newNovel);
                return $this->redirectToRoute('ks_blog_admin_addnovel');
            } 
        }

    //////////////////////////////////////////////////////////////////////////////////////////////////
        // si on choisit une catégorie existante(form2)
        if ($request->isMethod('POST') && ($form2->handleRequest($request)->isValid())) {

            // ajout dans la session
            $data = $form2->getData();
            $category = $data['category'];
            $categoryId = array('categoryId' => $category->getId());

            // dans le cas de l'ajout d'un livre
            if ($session->has('newBook')) {
                $newBook = $session->get('newBook');
                array_push($newBook, $categoryId);
                $session->set('newBook', $newBook);
                return $this->redirectToRoute('ks_blog_admin_addsaga');
            }

            //dans le cas de l'ajout d'une nouvelle    
            if ($session->has('newNovel')) {
                $newNovel = $session->get('newNovel');
                array_push($newNovel, $categoryId);
                $session->set('newNovel', $newNovel);
                return $this->redirectToRoute('ks_blog_admin_addnovel');
            } 
        }
        return $this->render('@KSBlog/KFarall/addcategory.html.twig', array(
            'form1'   => $form1->createView(),
            'form2'  =>$form2->createView()));
    }


// ajout d'un livre, étape 2 --- ajout d'une série (saga)
    public function addsagaAction(Request $request)
    {
        // 2EME ETAPE DE L'AJOUT de PUBLICATIONS
        $session = $request->getSession();

        // creation d'une nouvelle série de romans si désiré
        $saga = new Sagas();
        $form1 = $this->get('form.factory')->create(SagasType::class, $saga);

        // choix d'une série existante
        $form2 = $this->createFormBuilder()
        ->add('saga', EntityType::class, array('class'          => 'KSBlogBundle:Sagas',
                                               'choice_label'   => 'name',
                                               'multiple'       => false))
        ->getForm();

    //////////////////////////////////////////////////////////////////////////////////////////////////
        // si on ajoute une nouvelle saga (form1)
        if ($request->isMethod('POST') && $form1->handleRequest($request)->isValid()) {
     
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($saga);
            $em->flush();

            // ajout dans la session
            $sagaId = array('sagaId' => $saga->getId());
            $newBook = $session->get('newBook');
            array_push($newBook, $sagaId);
            $session->set('newBook', $newBook);
        
            return $this->redirectToRoute('ks_blog_admin_addbook');
        }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    // si on choisit une saga existante(form2)
    if ($request->isMethod('POST') && ($form2->handleRequest($request)->isValid())) {

        // ajout dans la session
        $data = $form2->getData();
        $saga = $data['saga'];
        $sagaId = array('sagaId' => $saga->getId());

                    $newBook = $session->get('newBook');
                    array_push($newBook, $sagaId);
                    $session->set('newBook', $newBook);
                    return $this->redirectToRoute('ks_blog_admin_addbook');        
        }
        return $this->render('@KSBlog/KFarall/addsaga.html.twig', array(
            'form1' => $form1->createView(),
            'form2' => $form2->createView()));
    }


// ajout d'un livre dans la db, étape 3
    public function addbookAction(Request $request)
    {
        // récupération des données de la session
        $session = $request->getSession();
        $newBook = $session->get('newBook');
        $categoryId = $newBook[0]['categoryId'];
        $sagaId = $newBook[1]['sagaId'];
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Category');
        $category = $rep->find($categoryId);
        $rep2 = $em->getRepository('KSBlogBundle:Sagas');
        $saga = $rep2->find($sagaId);
       
        $book = new Books();
        $form = $this->createFormBuilder()
        ->add('name', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Nom du livre'
            )
        ))
        ->add('content', TextAreaType::class, array(
            'attr' => array(
                'placeholder' => 'Résumé'
            )
        ))
        ->add('numero', IntegerType::class, array(
            'attr' => array(
                'placeholder' => 'N° du livre'
            )
        ))
        ->add('nbpages', IntegerType::class, array(
            'attr' => array(
                'placeholder' => 'Nombre de pages'
            )
        ))
        ->add('internetPrice', IntegerType::class, array(
            'attr' => array(
                'placeholder' => 'Prix e-book'
            )
        ))
        ->add('physicalPrice', IntegerType::class, array(
            'attr' => array(
                'placeholder' => 'Prix broché'
            )
        ))
        ->add('amazonLink', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Lien Amazon'
            )
        ))
        ->add('amazonApercu', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Lien aperçu Amazon'
            )
        ))
        ->add('isbn', TextType::class, array(
            'attr' => array(
                'placeholder' => 'ISBN'
            )
        ))
        ->add('image', ImagesType::class, array(
            'attr' => array(
                'placeholder' => 'Couverture'
            )
        ))
        ->add('active', CheckboxType::class, array(
              'label'    => 'visible par les visiteurs',
              'attr' => array('checked'   => 'checked'),
              'required' => false))
        ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // SAUVEGARDE
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $book->setCategory($category);
            $book->setSaga($saga);
            $book->setName($data['name']);
            $book->setContent($data['content']);
            $book->setNumero($data['numero']);
            $book->setNbpages($data['nbpages']);
            $book->setInternetPrice($data['internetPrice']);
            $book->setPhysicalPrice($data['physicalPrice']);
            $book->setAmazonLink($data['amazonLink']);
            $book->setAmazonApercu($data['amazonApercu']);
            $book->setIsbn($data['isbn']);
            $book->setActive($data['active']);
            $book->setImage($data['image']);

            $em->persist($book);
            $em->flush();
            $session->clear();

            return $this->redirectToRoute('ks_blog_publication', ['id' => $book->getId()]);
        }
        return $this->render('@KSBlog/KFarall/addbook.html.twig', array('form' => $form->createView()));
    }


/* *****************************  EDITION PUBLICATION EXISTANTE  ***************************** */

    public function editbookAction(Request $request, Books $book)
    {
       
       $form = $this->get('form.factory')->create(BooksType::class, $book);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('ks_blog_publication', ['id' => $book->getId()]);
        }
        return $this->render('@KSBlog/KFarall/addbook.html.twig', array('edit' => 'edit', 'form' => $form->createView()));
    }

/* *********************************  SUPPRESSION PUBLICATION ********************************* */

    public function deletebookAction(Request $request, Books $book)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('ks_blog_admin_homepage');
    }


/*************************************************************************************************/
/* ************************************  SECTION NOUVELLES  ************************************ */
/*************************************************************************************************/

// une liste de nouvelles sans sélection de catégorie
    public function listeNouvellesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Novels');
        $novels = $rep->findAll();

        return $this->render('@KSBlog/KFarall/listeNouvelles.html.twig', ['novels' => $novels]);
    }


// liste de nouvelles en fonction des catégories
    public function nouvellesCategoryAction($category)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Novels');
        $novels = $rep->findBy(array('category' => $category));

        return $this->render('@KSBlog/KFarall/listeNouvelles.html.twig', ['novels' => $novels]);
    }

// affichage d'une nouvelle spécifique
    public function nouvelleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Novels');
        $novel = $rep->find($id);

        return $this->render('@KSBlog/KFarall/nouvelle.html.twig', ['novel' => $novel]);
    }


/*************************************************************************************************/
/* ******************************* AJOUT DE NOUVELLES DANS LA DB ******************************* */
/*************************************************************************************************/

// ajout d'une nouvelle dans la db, étape 2 (étape 1 commune avec Publications, voir plus haut)
    public function addnovelAction(Request $request)
    {
        $novel = new Novels();
        $form = $this->get('form.factory')->create(NovelsType::class, $novel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            // récupération des données de la session
            $session = $request->getSession();
            $newNovel = $session->get('newNovel');
            $categoryId = $newNovel[0]['categoryId'];
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('KSBlogBundle:Category');
            $category = $rep->find($categoryId);
            
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $novel->setCategory($category);
            $em->persist($novel);
            $em->flush();
            $session->clear();

            return $this->redirectToRoute('ks_blog_admin_homepage');
        }
        return $this->render('@KSBlog/KFarall/addnovel.html.twig', array(
            'form' => $form->createView()));
    }


/* *****************************  EDITION NOUVELLE EXISTANTE  ***************************** */

    public function editnovelAction(Request $request, Novels $novel)
    {
       
       $form = $this->get('form.factory')->create(NovelsType::class, $novel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($novel);
            $em->flush();
            return $this->redirectToRoute('ks_blog_nouvelle', ['id' => $novel->getId()]);
        }
        return $this->render('@KSBlog/KFarall/addnovel.html.twig', array('edit' => 'edit', 'form' => $form->createView()));
    }


/* *********************************  SUPPRESSION NOUVELLE ********************************* */

    public function deletenovelAction(Request $request, Novels $novel)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($novel);
        $em->flush();

        return $this->redirectToRoute('ks_blog_admin_homepage');
    }


/*************************************************************************************************/
/* ***********************************  SECTION ACTUALITES  ************************************ */
/*************************************************************************************************/

// liste des actualités
    public function actuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Actu');
        $actus = $rep->findAll();

        return $this->render('@KSBlog/KFarall/actu.html.twig', ['actus' => $actus]);
    }

// affichage détaillé d'une seule actualité
    public function actuvueAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Actu');
        $actu = $rep->find($id);

        return $this->render('@KSBlog/KFarall/actuvue.html.twig', ['actu' => $actu]);
    }


// ajout d'une actualité dans la base de données
    public function addactuAction(Request $request, Actu $actu = null) 
    {
        if (!$actu) {
            $actu = new Actu();
        }

        $form = $this->get('form.factory')->create(ActuType::class, $actu);

        if ($request->isMethod('POST') && ($form->handleRequest($request)->isValid())) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($actu);
            $em->flush();

            return $this->redirectToRoute('ks_blog_actu');
        }

        return $this->render('@KSBlog/KFarall/addactu.html.twig', ['form' => $form->createView()]);
    }

/*************************************************************************************************/
/* ************************************  SECTION GUESTBOOK  ************************************ */
/*************************************************************************************************/

// affichage du livre d'or + formulaire
    public function guestbookAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Guestbook');
        $guestbooklist = $rep->orderGuestbookByDate();

        // pour qu'un visiteur ajoute un commentaire
        $guestbook = new Guestbook();
        $form = $this->createFormBuilder()
        ->add('username', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Votre nom'
            )
        ))
        ->add('content', TextareaType::class, array(
            'attr' => array(
                'placeholder' => 'Votre message'
            )
        ))
        ->getForm();

        if ($request->isMethod('POST') && ($form->handleRequest($request)->isValid())) {
            // SAUVEGARDE
            $data = $form->getData();
            $guestbook->setUsername($data['username']);
            $guestbook->setContent($data['content']);
            $guestbook->setActive(0);
            $guestbook->setDate(new \DateTime());

            // génération aléatoire d'une clef pour la validation du comm par un moderateur et pour la suppression
            $guestbook->setClef(md5(microtime(TRUE)*100000));
            $guestbook->setSuppr(md5(microtime(TRUE)*200000));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($guestbook);
            $em->flush();
            
            // ENVOI D'UN EMAIL AU MODERATEUR POUR VALIDATION DU COMMENTAIRE
            // préparation de l'évènement
            $event = new MessagePostEvent($guestbook->getContent(), $guestbook->getUsername(), $guestbook->getClef(), $guestbook->getSuppr(), $guestbook->getId());
            // On déclenche l'évènement
            $this->get('event_dispatcher')->dispatch(BlogEvent::POST_MESSAGE, $event);

            return $this->redirectToRoute('ks_blog_guestbook');
        }
        return $this->render('@KSBlog/KFarall/guestbook.html.twig', ['form' => $form->createView(), 'guestbooklist' => $guestbooklist]);
    }


// validation des commentaires
    public function validationAction($key, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Guestbook');
        $guestbook = $rep->findOneBy(array('id' => $id));
        $active = $guestbook->getActive();
        $dbkey = $guestbook->getClef();
        $dbsuppr = $guestbook->getSuppr();

        if ($active) {

            return $this->render('@KSBlog/KFarall/validation.html.twig', ['response' => 'Commentaire déja validé']);

        } else if ($dbkey == $key) {
            // dans le cas ou le comm est validé, on l'active et il devient visible sur la page guestbook
            $em = $this->getDoctrine()->getManager();
            $guestbook->setActive(1);
            $em->persist($guestbook);
            $em->flush();
            return $this->render('@KSBlog/KFarall/validation.html.twig', ['response' => 'Commentaire validé']);

        } else if ($dbsuppr == $key) {
            // dans le cas ou le comm est rejeté, on le supprime
            $em = $this->getDoctrine()->getManager();
            $em->remove($guestbook);
            $em->flush();
            return $this->render('@KSBlog/KFarall/validation.html.twig', ['response' => 'Commentaire supprimé']);

        } else {

            return $this->render('@KSBlog/KFarall/validation.html.twig', ['response' => "Erreur, ce commentaire ne peut pas être activé..."]);
        }
    }

/* *********************************  MODERATION GUESTBOOK  ********************************* */

    public function editguestbookAction(Request $request, Guestbook $guestbook)
    {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();

            if ($guestbook->getActive() ==1 ) {
                $guestbook->setActive(0);
            } else if ($guestbook->getActive() == 0) {
                $guestbook->setActive(1);
            }

            $em->persist($guestbook);
            $em->flush();
            return $this->redirectToRoute('ks_blog_guestbook');
    }


    public function deleteguestbookAction(Request $request, Guestbook $guestbook)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($guestbook);
        $em->flush();

        return $this->redirectToRoute('ks_blog_guestbook');
    }


/*************************************************************************************************/
/* **************************************  SECTION PRESSE  ************************************* */
/*************************************************************************************************/

/* **************************************  PARTENARIATS  ************************************* */
    public function partenariatAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Partenariats');
        $partenariats = $rep->findAll();

        return $this->render('@KSBlog/KFarall/partenariat.html.twig', ['partenariats' => $partenariats]);
    }

// ajout- édition d'un partenariat
    public function addpartenariatAction(Request $request, Partenariats $partenariat = null)
    {
        if (!$partenariat) {
            $partenariat = new Partenariats();
        }
        $form   = $this->get('form.factory')->create(PartenariatsType::class, $partenariat);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partenariat);
            $em->flush();

            return $this->redirectToRoute('ks_blog_partenariat');
        }
        return $this->render('@KSBlog/KFarall/addpartenariat.html.twig', ['form' => $form->createView(), 'editMode' => $partenariat->getId()!== null]);
    }


    public function deletepartenariatAction(Request $request, Partenariats $partenariat)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($partenariat);
        $em->flush();

        return $this->redirectToRoute('ks_blog_partenariats');
    }

/* **************************************  CHRONIQUES  ************************************* */ 

// affichage des chroniques dans le twig
    public function chroniquesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Sagas');
        $sagas = $rep->findAll(); 

        $sagasArray = array();
        $novelsArray = array();

    foreach ($sagas as $saga) {
        $sagaChronique = $saga->getChroniques();
        // si il existe des chroniques pour cette saga on push dans le tableau
            if (count($sagaChronique)) {
                // ensuite, on vérifie si des livres appartenant a cette saga possèdent des chroniques
                $rep = $em->getRepository('KSBlogBundle:Chroniques');
                $books = $rep->findChroniquesBooksIfSagaIsNotNull($saga);
            
                // on crée le tableau a push dans sagasArray
                $sagaChroniquesListe = array(
                    'sagaChronique' => $saga,
                    'books' => $books);
                    array_push($sagasArray, $sagaChroniquesListe);
            } // fin if
    } // fin foreach

        $rep = $em->getRepository('KSBlogBundle:Novels');
        $novels = $rep->findAll();

        foreach ($novels as $novel ) {
            $novelChronique = $novel->getChroniques();
        
            if (count($novelChronique)) {
                $novelChroniquesListe = array(
                    'novelChronique' => $novelChronique,
                    'novel' => $novel);
                    array_push($novelsArray, $novelChroniquesListe);  
            }
        }
        return $this->render('@KSBlog/KFarall/chroniques.html.twig', ['sagasArray' => $sagasArray, 'novelsArray' => $novelsArray]);
    }

/******************** AJOUT D'UNE CHRONIQUE DANS LA DB *************************/

// fonctionne en 2 étapes : 
// d'abord choisir si la chronique concerne une saga, un livre ou une nouvelle
// puis enfin enregistrer la chronique


// étape 1 :
// ajout d'une chronique - 3 options : 1-pour une série, 2-pour un livre, 3-pour une nouvelle
    public function addchroniqueAction(Request $request)
    {
        // ici 3 choix : chronique d'une série entière (form1) ou d'un livre (form2) ou nouvelle (form3)
        $chronique = new Chroniques();

        // form1 pour chronique d'une série entière
        $form1 = $this->createFormBuilder()
        ->add('saga', EntityType::class, array('class'          => 'KSBlogBundle:Sagas',
                                               'choice_label'   => 'name',
                                               'multiple'       => false))
        ->getForm();

        // form2 pour chronique d'un livre en particulier
        $form2 = $this->createFormBuilder()
        ->add('book', EntityType::class, array('class'          => 'KSBlogBundle:Books',
                                               'choice_label'   => 'name',
                                               'multiple'       => false))
        ->getForm();

        // form3 pour chronique d'une nouvelle
        $form3 = $this->createFormBuilder()
        ->add('novel', EntityType::class, array('class'          => 'KSBlogBundle:Novels',
                                               'choice_label'   => 'name',
                                               'multiple'       => false))
        ->getForm();

        ///////////////////////////////////////////////////////////////////////////////////
        /// VALIDATION DES FORMULAIRES

        // dans le cas d'une série : 
        if ($request->isMethod('POST') && $form1->handleRequest($request)->isValid()) {
            // SAUVEGARDE
        $data = $form1->getData();
        $saga = $data['saga'];
        $session = $request->getSession();
        $session->set('saga', $saga);

            return $this->redirectToRoute('ks_blog_admin_addchroniquecontent');
        }

        // dans le cas d'un livre : 
        if ($request->isMethod('POST') && $form2->handleRequest($request)->isValid()) {
            // SAUVEGARDE
        $data = $form2->getData();
        $book = $data['book'];
        $session = $request->getSession();
        $session->set('book', $book);

            return $this->redirectToRoute('ks_blog_admin_addchroniquecontent');
        }

        // dans le cas d'une nouvelle : 
        if ($request->isMethod('POST') && $form3->handleRequest($request)->isValid()) {
            // SAUVEGARDE
        $data = $form3->getData();
        $novel = $data['novel'];
        $session = $request->getSession();
        $session->set('novel', $novel);

            return $this->redirectToRoute('ks_blog_admin_addchroniquecontent');
        }
        return $this->render('@KSBlog/KFarall/addchronique.html.twig', ['form1' => $form1->createView(), 'form2' => $form2->createView(), 'form3' => $form3->createView()]);
    }

// étape 2 :
// ajoute une chronique dans la db
    public function addchroniquecontentAction(Request $request)
    {
        $chronique = new Chroniques();

        $form = $this->createFormBuilder()
        ->add('name', TextType::class, array(
            'attr' => array(
            'placeholder' => 'Titre du lien'
                )
            ))
        ->add('url', TextType::class, array(
            'attr' => array(
            'placeholder' => 'Adresse http://...'
                )
            ))
        ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            // récuperation de la session
            $session = $request->getSession();

            // sauvegarde série
            if ($session->has('saga')) {
                $saga = $session->get('saga')->getId();
                $rep = $em->getRepository('KSBlogBundle:Sagas');
                $sagaDb = $rep->findOneBy(array('id' => $saga));
                $chronique->setSaga($sagaDb);
                $chronique->setBook(null);
                $chronique->setNovel(null);
            }

            // sauvegarde livre
            if ($session->has('book')) {
                $book = $session->get('book')->getId();
                $rep = $em->getRepository('KSBlogBundle:Books');
                $bookDb = $rep->findOneBy(array('id' => $book));
                $chronique->setSaga($bookDb->getSaga());
                $chronique->setBook($bookDb);
                $chronique->setNovel(null);
            }

            // sauvegarde nouvelle
            if ($session->has('novel')) {
                $novel = $session->get('novel')->getId();
                $rep = $em->getRepository('KSBlogBundle:Novels');
                $novelDb = $rep->findOneBy(array('id' => $novel));
                $chronique->setSaga(null);
                $chronique->setBook(null);
                $chronique->setNovel($novelDb);
            }
            $chronique->setDate(new \DateTime());
            $chronique->setName($data['name']);
            $chronique->setUrl($data['url']);

            // SAUVEGARDE
            $em->persist($chronique);
            $em->flush();
            $session->clear();
            
            return $this->redirectToRoute('ks_blog_chroniques');
        }
        return $this->render('@KSBlog/KFarall/addchroniquecontent.html.twig', ['form' => $form->createView()]);
    }

/******************** EDITION / SUPPRESSION D'UNE CHRONIQUE *************************/

    public function editchroniqueAction(Request $request, Chroniques $chronique)
    {
        $form = $this->get('form.factory')->create(ChroniquesType::class, $chronique);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($chronique);
            $em->flush();
            return $this->redirectToRoute('ks_blog_chroniques');
        }
        return $this->render('@KSBlog/KFarall/newcategory.html.twig', ['editMode' => $chronique->getId()!== null, 'title' =>'Editer une chronique', 'form' => $form->createView()]);
    }


    public function deletechroniqueAction(Request $request, Chroniques $chronique)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($chronique);
        $em->flush();

        return $this->redirectToRoute('ks_blog_chroniques');
    }

/* **************************************  INTERVIEWS  ************************************* */

    public function interviewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Interviews');
        $interviews = $rep->findAll();

        return $this->render('@KSBlog/KFarall/interviews.html.twig', ['interviews' => $interviews]);
    }


// ajout - édition d'une interview
    public function addinterviewAction(Request $request, Interviews $interview = null)
    {
        if (!$interview) {
            $interview = new Interviews();
        }
        $form   = $this->get('form.factory')->create(InterviewsType::class, $interview);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($interview);
            $em->flush();

            return $this->redirectToRoute('ks_blog_interviews');
        }
        return $this->render('@KSBlog/KFarall/addinterview.html.twig', ['form' => $form->createView(), 'editMode' => $interview->getId()!== null]);
    }


    public function deleteinterviewAction(Request $request, Interviews $interview)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($interview);
        $em->flush();

        return $this->redirectToRoute('ks_blog_interviews');
    }

/* **************************************  KITS PRESSE ************************************* */

public function kitspresseAction()
{
    return $this->render('@KSBlog/KFarall/kitspresse.html.twig');
}
    

/*************************************************************************************************/
/* ***************************************  SECTION ADMIN  ************************************* */
/*************************************************************************************************/
    
// affichage du panneau d'administration, pour gérer l'édition / suppression des livres, séries, catégories et nouvelles
    public function adminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Books');
        $books = $rep->findAll();

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Novels');
        $novels = $rep->findAll();

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Category');
        $category = $rep->findAll();

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('KSBlogBundle:Sagas');
        $sagas = $rep->findAll();

        return $this->render('@KSBlog/KFarall/admin.html.twig', ['books' => $books, 'novels' => $novels, 'category' => $category, 'sagas' => $sagas]);
    }


//création d'une catégorie directement (sans créer de livre ni de nouvelle ensuite) - edition d'ue catégorie existante
    public function newcategoryAction(Request $request, Category $category = null)
    {
        if (!$category) {
            $category = new Category();
        }

        $form = $this->get('form.factory')->create(CategoryType::class, $category);

        if ($request->isMethod('POST') && ($form->handleRequest($request)->isValid())) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('ks_blog_admin_homepage');
        }
        return $this->render('@KSBlog/KFarall/newcategory.html.twig', ['form' => $form->createView(), 'title' => 'Editer une catégorie', 'editMode' => $category->getId()!== null]);
    }


//création d'une série directement (sans créer de livre ni de nouvelle ensuite) - edition d'une série existante
    public function newsagaAction(Request $request, Sagas $saga = null)
    {
        if(!$saga) {
            $saga = new Sagas();
        }

        $form = $this->get('form.factory')->create(SagasType::class, $saga);

        if ($request->isMethod('POST') && ($form->handleRequest($request)->isValid())) {
            // SAUVEGARDE
            $em = $this->getDoctrine()->getManager();
            $em->persist($saga);
            $em->flush();

            return $this->redirectToRoute('ks_blog_admin_homepage');
        }
        return $this->render('@KSBlog/KFarall/newsaga.html.twig', ['form' => $form->createView(), 'editMode' => $saga->getId()!== null]);
    }


/*************************************************************************************************/
/* ****************************************  REDIRECTIONS  ************************************* */
/*************************************************************************************************/

/* les redirections servent à se souvenir si l'on cherche à ajouter une publication ou une nouvelle
car la première étape est commune à chacune des deux actions. Les redirections conservent en mémoire 
l'origine de la demande  (voir addcategoryAction )*/ 

    public function redirectNewBookAction(Request $request)
    {
            // création de la session, ajout de "book" s'il n'est pas déja présent, 
            // nous servira pour la suite (pour différencier de l'ajout de nouvelles)
        if(!isset($session)) {
            $session = $request->getSession();
        }
        // destruction de l'éventuelle $session(newNovel) pour ne pas confondre les routes
        if ($session->has('newNovel')) {
        $session->remove('newNovel');
        }
        $session->set('newBook',array());

        return $this->redirectToRoute('ks_blog_admin_addcategory');
    }


    public function redirectNewNovelAction(Request $request)
    {
            // création de la session, ajout de "novel" s'il n'est pas déja présent, 
            // nous servira pour la suite (pour différencier de l'ajout de books)
        if(!isset($session)) {
            $session = $request->getSession();
        }
        // destruction de l'éventuelle $session(newBook) pour ne pas confondre les routes
        if ($session->has('newBook')) {
        $session->remove('newBook');
        }
        $session->set('newNovel',array());

        return $this->redirectToRoute('ks_blog_admin_addcategory');
    }

} // fin controller