function add_button(Id,Class,Content,onclick){
	let tag="<button "+"id= "+"\""+Id+"\""+"class="+"\""+Class+"\"+ onclick=\""+onclick+"\">"+Content+"</button>";
	return tag;
}
function add_select(Id,Class,Content){
	let tag="<select "+"id= "+"\""+Id+"\""+"class="+"\""+Class+"\">"+Content+"</select>";
	return tag;
}
function add_option(Value,Content){
	let tag="<option "+"value= "+"\""+Value+"\">"+Content+"</option>";
	return tag;
}
function add_div(Id,Class,Content){
	let tag="<div "+"id= "+"\""+Id+"\""+"class="+"\""+Class+"\">"+Content+"</div>";
	return tag;
}
function add_li(Id,Class,Content){
	let tag="<li "+"id= "+"\""+Id+"\""+"class="+"\""+Class+"\">"+Content+"</li>";
	return tag;
}
function add_p(Id,Class,Content){
	let tag="<p "+"id= "+"\""+Id+"\""+"class="+"\""+Class+"\">"+Content+"</p>";
	return tag;
}
