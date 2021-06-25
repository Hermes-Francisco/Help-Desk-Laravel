$("#opcao").click(()=>{
    $("#mais").show();
    $("#opcoes").hide();
})

$("#fechar").click(()=>{
    $("#question_delete").show();
    $("#recuperacao").show();
    $("#mais").hide();
    $("#confirm").hide();
    $("#opcoes").show();
})

$("#nao").click(()=>{
    $("#question_delete").show();
    $("#recuperacao").show();
    $("#confirm").hide();
})

$("#question_delete").click(()=>{
    $("#question_delete").hide();
    $("#recuperacao").hide();
    $("#confirm").show();
})
