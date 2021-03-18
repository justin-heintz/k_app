<div class="container">
	<!-- <div>Current Balance: </div><div>Cost: </div>-->
	<form method="post" enctype="multipart/form-data">
		
		<label >Group Title <input type="text" name="g_title"></label>
		<label>Group  Description<textarea name="g_description"></textarea></label>
		<label>Group  Banner<input type="file" name="g_image"></label>
		<hr>
		<div id="t_add" class="btn btn-primary">Add Task</div>
		<div id="tasks"></div>
		<hr>
		<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
		<input class="btn btn-success" type="submit">
	</form>
</div>

<div id="t_template" class="hidden">
	<div class="grouped ">
		<label>Task Title<input type="text" name="t_title[]"></label>
		<label >Task Type<select  name="t_type[]" >
			<?PHP
			foreach($types as $type){
				echo "<option value='".$type->id."'>".$type->name."</option>";
			} ?>
		</select></label>
		<label >Task Credit<input type="text" name="t_credit[]"></label>
		<label >Max Users<input type="number" value="0" min="0"  name="t_max_users[]"></label>
		<div class="t_remove btn btn-danger">X</div>
	</div>
</div>

<script>
function in_array(needle, haystack){
    var found = 0;
    for (var i=0, len=haystack.length;i<len;i++) {
        if (haystack[i] == needle) return i;
            found++;
    }
    return false;
}
window.onload = function(){
	tinymce.init({selector:'textarea'});
	
	document.getElementById('t_add').addEventListener('click', function(e){
		div = document.createElement('div');
		div.innerHTML = document.getElementById('t_template').innerHTML;
		document.getElementById('tasks').appendChild( div  )
	});
	
	document.addEventListener('click' ,function(e){
		if(e.target &&  e.target.className.includes('t_remove') ){
			e.target.parentElement.remove();
		}
	});	
	
};
</script>