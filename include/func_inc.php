<?php

/*********************
 * Class BootstrapForm
 *********************/
class BootstrapForm{

    public $errors;
    public $response;

    public function __construct($response){
        $this->response = $response;
    }

    /**
     * @param $name
     * @return string
     */
    public function text($name, $option=array()){
        //var_dump($this->response->request->data[0]->{'get'.ucfirst($name)}());
        //S'il s'agit d'une modification
        // Class
        $require = (in_array($name, array_keys($this->response->validators)))?'*':'';

        $classError = '';
        if (isset($this->errors[$name]) AND !empty($this->errors[$name])) {

            // print_r($this->errors);
            $classError .= 'alert alert-danger';
            $error = $this->errors[$name];


        }

        $attributes = "";

        // Si il ya des attributes, il faut les mettres
        if(isset($option['attr'])){
            foreach ($option['attr'] as $attr => $val) {
                $attributes .= "$attr='$val'";
            }
        }

        //Si les informations sont disponibles, il faut les recuperer
        if (isset($this->response->request->data) AND !empty($this->response->request->data)) {
            $value = $this->response->request->data->$name;
        }else{
            $value = '';
        }


        if(!empty($option['balise']) AND $option['balise']==='textarea'){
            $text = '<div class="form-group '.$classError.'">';
            $text .= "<label style='margin-right:10px;' for='tinytextarea' >$name $require</label>";
            $text.= "<textarea type='text' ".$attributes." name='$name' >".$value."</textarea>";
        }elseif(!empty($option['balise']) AND $option['balise']==='checkbox'){
            $text = '<div class="form-check '.$classError.'">';
            //selectionner le checkbox en cas lieu
            //$value = $this->response->request->data[0]->{'get'.ucfirst($name)}();
            $checked = ($value == 1)?'checked="checked"':'';

            $text .= '<input type="checkbox"  id="'.$name.'" '.$checked.' '.$attributes.'  onclick="javascript:toggleChecked(\'hidden'.$name.'\')" id="'.$name.'">';
            $text .= '<input type="hidden" name="'.$name.'" value="'.$value.'" id="hidden'.$name.'">';
            $text .= '<label class="form-check-label" for="'.$name.'">'.$name.'</label><br>';

        }elseif(!empty($option['balise']) AND $option['balise']==='hidden'){
            $text = '<div class="form-group'.$classError.'">';
            //$value= ($this->response->request->data[0]->{'get'.ucfirst($name)}());
            $text .= '<input type="hidden" name="'.$name.'" class="form-check-input" id="'.$name.'" value="'.$value.'">';
        }elseif(!empty($option['balise']) AND $option['balise']==='file'){
            $text = '<div class="form-group '.$classError.'">';
            //$value= ($this->response->request->data[0]->{'get'.ucfirst($name)}());
            $text .= '<input type="file" name="'.$name.'" class="form-control-file" id="'.$name.'">';
        }elseif(!empty($option['balise']) AND $option['balise']==='select' AND is_array($option['option'])){

            $text = '<div class="form-group '.$classError.'">';
            $text .= "<label for='".$name."' >$name</label>";
            $text .= '<select id="'.$name.'" name="'.$name.'" '.$attributes.'>';
            foreach ($option['option'] as $k => $v) {
                $has_select = (($value !='') AND ($value == $v))?'selected':'';
                $text .='<option '.$has_select.' value="'.$v.'">'.$v.'</option>';
            }
            $text .='</select>';

            //$value= ($this->response->request->data[0]->{'get'.ucfirst($name)}());
        }elseif (empty($option) OR $option['balise']==='input') {
            $text = '<div class="form-group '.$classError.'">';
            $text .= "<label style='margin-right:10px;' for='$name'>$name $require</label>";
            $text.= "<input type='text' id='".$name."' name='$name' value=\"$value\" ".$attributes.">";
        }
        if (isset($error)) {
            $text .='<span class="help-inline">'.$error.'</span>';
        }

        $text .= "</div>";

        return $text;
    }

    public function send($libelle='Submit'){
        $text = '<div class="form-group" style="padding-top:10px;">';
        $text .= '<button type="submit" class="btn btn-primary">'.$libelle.'</button>';
        $text .= '</div>';
        echo $text;
    }
}

/***********************
 * Class Session
 */
class Session{
    public function __construct(){
        if(!isset($_SESSION))
            session_start();
    }

    public function setFlash($message, $type='success'){
        $_SESSION['flash'] = array(
            'message'	=> $message,
            'type'		=> $type
        );
    }

    public function flash(){
        if(isset($_SESSION['flash'] )){
            $message = '<div style="text-align:center;" class="alert alert-'.$_SESSION['flash']['type'].' alert-dismissible fade show" role="alert"><p>'.$_SESSION['flash']['message'].'</p>';
            $message.='<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';

            $_SESSION = array();
            return $message;
        }

    }
}