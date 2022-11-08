$j("#idade_inicial").closest('tr').hide();
$j("#idade_final").closest('tr').hide();

$j("#idade").on('click', function(){
	if($j('#idade_check').prop('checked')){
		$j("#idade_inicial").closest('tr').show();
		$j("#idade_final").closest('tr').show();
		$j("#data_inicial").val("");
        $j("#data_inicial").closest('tr').hide();
		$j("#data_final").val("");
		$j("#data_final").closest('tr').hide();
	}else{
		$j("#idade_inicial").val("");
		$j("#idade_inicial").closest('tr').hide();
		$j("#idade_final").val("");
		$j("#idade_final").closest('tr').hide();
        $j("#data_inicial").closest('tr').show();
		$j("#data_final").closest('tr').show();
	}
});