<?
	/*
		copyrights reserved for www.roznamti.com
		2012-2013
		IT department 
		HTML data here 
	*/
	

	class formHtml 
	{
		///open tage from 
		function openForm($method,$action,$name,$id,$js='')
		{
			unset($data);
			$data='<form method="'.$method.'" action="'.$action.'" enctype="multipart/form-data" name="'.$name.'" id="'.$id.'" '.$js.'> '  ;
			return $data;
		}
		///close form 
		function closeForm()
		{
			unset($data);
			$data='</form>';
			return $data;
		}
		//* build text box*/
		function textBox($name,$id,$size,$js='',$value='',$class='',$readOnly='')
		{
			unset($data);
			$data='<input type="text" name="'.$name.'" id="'.$id.'" size="'.$size.'" value="'.$value.'" '.$js.' class="'.$class.'" "'.$readOnly.'">';
			return $data;
		}
        //* build password box*/
		function passwordBox($name,$id,$size,$js='',$value='',$class='')
		{
			unset($data);
			$data='<input type="password" name="'.$name.'" id="'.$id.'" size="'.$size.'" value="'.$value.'" '.$js.' class="'.$class.'">';
			return $data;
		}
		//* build check box */
		function checkBox($name,$id,$size,$js='',$label,$checked='',$class='',$val='')
		{
			unset($data);
			$data='<input type="checkbox" name="'.$name.'" id="'.$id.'" size="'.$size.'" '.$js.' '.$checked.' '.$class.' '.$val.'>'.$label.' &nbsp;';
			return $data;
		}
        //* build Radio button */
		function radioButton($name,$id,$size,$js='',$label,$checked='',$class='')
		{
			unset($data);
			$data='<input type="radio" name="'.$name.'" id="'.$id.'" size="'.$size.'" '.$js.' '.$checked.' '.$class.'>'.$label.' &nbsp;';
			return $data;
		}
        /*open select box*/
        function openSelectBox($name,$id,$size,$js='',$class='')
		{
			unset($data);
            $data='<select name="'.$name.'" id="'.$id.'" size="'.$size.'" '.$js.' class="'.$class.'">';
			return $data;
		}
        /*close select Box*/
        function closeSelectBox()
		{
			unset($data);
			$data = '</select>';
			return $data;
		}
        /*build select option*/
        function selectOption($value,$label,$checked='')
		{
			unset($data);
			$data = '<option value="'.$value.'" '.$checked.'>'.$label.' &nbsp;</option>';
			return $data;
		}
        /*build label*/
        function label($for='',$label,$class='')
		{
			unset($data);
			$data = '<label for="'.$for.'" class="'.$class.'">'.$label.' &nbsp;</label>';
			return $data;
		}
        /*build submit*/
        function submit($name,$id,$value='',$js='',$class='')
		{
			unset($data);
			$data='<input type="submit" value="'.$value.'" name="'.$name.'" id="'.$id.'" '.$js.' class="'.$class.'" >';
			return $data;
		}
         /*build submit*/
        function button($name,$id,$value='',$js='',$class='')
		{
			unset($data);
			$data='<input type="button" value="'.$value.'" name="'.$name.'" id="'.$id.'" '.$js.' class="'.$class.'">';
			return $data;
		}
		 function resetButton($name,$id,$value='',$js='',$class='')
		{
			unset($data);
			$data='<input type="reset" value="'.$value.'" name="'.$name.'" id="'.$id.'" '.$js.' class="'.$class.'">';
			return $data;
		}
        /*hidden input*/
        function hidden($name,$id,$value='',$js='')
		{
			unset($data);
			$data='<input type="hidden" value="'.$value.'" name="'.$name.'" id="'.$id.'" '.$js.'>';
			return $data;
		}
        /*build disable check box*/
		function checkBoxdisable($name,$id,$size,$js='',$label,$checked='',$class='')
		{
			unset($data);
			$data='<input type="checkbox" name="'.$name.'" id="'.$id.'" size="'.$size.'" '.$js.' '.$checked.' '.$class.' disabled="disabled">'.$label.' &nbsp;';
			return $data;
		}
        /*image upload*/
        function imageUpload($name,$id,$js='')
		{
			unset($data);
			$data='<input type="file" name="'.$name.'" id="'.$id.'" '.$js.'>';
			return $data;
		}
        /*textArea */
        function textArea($name,$id,$js='',$rows,$cols,$class='',$value='')
		{
			unset($data);
			$data='<textarea name="'.$name.'" id="'.$id.'" '.$js.' rows="'.$rows.'" cols="'.$cols.'" '.$class.'>'.$value.'</textarea>';
			return $data;
		}
	}
?>