 <?php
 
class OmistajaController extends BaseController{
    
    // Haetaan kaikki omistajat tietokannasta
    
    public static function listaa(){
       $omistajat = Omistaja::all(); 
       View::make('omistaja/omistajat_listaus.html', array('omistajat' => $omistajat));
    }
  
    
    // Alla olevia ei käytetä
    
    // Yksittäisen omistajan tiedot
    
    public static function show($om_id) {
        $omistaja = Omistaja::find($om_id);
        View::make('omistaja/omistajantiedot.html', array('omistaja' => $omistaja));
    }
    
    // Muokkaa omistaja, vain sisäänkirjautuneena
       
    public static function muokkaa($om_id){
        self::check_logged_in();
        $omistaja = Omistaja::find($om_id);
        View::make('omistaja/muutosb.html', array('omistaja' => $omistaja));
    }
         
    // Uuden omistajan lisäys, vain sisäänkirjautuneena
    
    public static function create(){
        self::check_logged_in();
        View::make('lisays/newb.html');
    }
    
    public static function store(){
   
        $params = $_POST;
       
        $attributes = (array(
          'nimi' => $params['nimi'],
         ));

        $omistaja = new Omistaja($attributes);
        $errors = $omistaja->errors();
    
        if(count($errors) > 0){
        View::make('/lisays/newb.html', array('errors' => $errors, 'attributes' => $attributes)); 
        }else{
      
        $omistaja->save();
        Redirect::to('/omistaja/' . $omistaja->om_id, array('message' => 'Omistaja on lisätty astiasto tietokantaan.'));
        }
    }
  
    // Omistajan muokkaaminen, vain sisäänkirjaututneena 
    
    public static function update($om_id){
        $params = $_POST;

        $attributes = array(
          'om_id' => $om_id,
          'nimi' => $params['nimi'],
          
        );

        $omistaja = new Omistaja($attributes);
        $errors = $omistaja->errors();

        if(count($errors) > 0){
        View::make('/omistaja/muutosb.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            
        $omistaja->update();
        Redirect::to('/omistaja/' . $omistaja->om_id, array('message' => 'Omistaja on nyt muokattu onnistuneesti!'));
      }
    }

    // Omistajan poistaminen, vain sisäänkirjautuneena
  
    public static function poista($om_id){
        self::check_logged_in();
   
        $omistaja = new Omistaja(array('om_id' => $om_id));
        $omistaja->destroy();

        Redirect::to('/omistaja', array('message' => 'Omistaja on  nyt poistettu onnistuneesti!'));
    }  
    
}
