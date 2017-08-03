"use strict";
var f_c_fields = ["176","199","219","285"];
var q_fields = ["177","200","220","286"];
window.priceNumber = function(d) {
    var r = (d == null) ? 0 : d,
        a = r.toString().split(/\./),
        na = [],
        n = "",
        f = "";
    if (d >= 1000) {
        na = a[0].split("").reverse();
        var c = 3;
        //console.debug(na);
        for (var i in na) {
            n += na[i];
            if (--c <= 0) {
                n += " ";
                c = 3;
            }
        }
        r = n.split("").reverse().join("") + ((a.length > 1) ? ("." + a[1]) : "");
    }
    return r;
};
var getAcceptedEntries = function(){
    return [];//["30","134","49"];
}
var getStock = function(ei){
    if(typeof(ExpressoStore)=="undefined")return false;
    if(typeof(ExpressoStore.products)=="undefined")return false;
    var products = (typeof(ExpressoStore.products[ei])=="undefined")?false:ExpressoStore.products[ei];
    if(products===false)return false;
    var st2 = {};
    for(var i in products.stock){
        var stockItem = products.stock[i];
        if(stockItem.stock_level!=null)continue;
        var ss = st2;
        for(var o in stockItem.opt_values){
            if(typeof(ss[o])=="undefined") ss[o] = {};
            if(typeof(ss[o][stockItem.opt_values[o]])=="undefined") ss[o][stockItem.opt_values[o]]={};
            ss = ss[o][stockItem.opt_values[o]];
        }
    }
    console.debug(st2);
    return st2;
};
window.onVarChange = function(p,stock){
    var s = stock;
    $.when($(".p-modifiers-select").each(function(){
        var $t = $(this), m = $t.attr("name").replace(/modifiers_(\d+)/,"$1"), v = $t.val();
        if(v==null||typeof(v)=="undefined")return false;
        if(typeof(s)=="undefined")return false;
        if(typeof(s[m])=="undefined")return false;
        if(typeof(s[m][v])=="undefined")return false;
        for(var i in s[m][v]){
            var t = $(".p-modifiers-select[name=modifiers_"+i+"] :selected").text();
            $(".p-modifiers-select[name=modifiers_"+i+"] option").addClass("no-display").hide();
            for(var j in s[m][v][i])$(".p-modifiers-select[name=modifiers_"+i+"] option[value="+j+"]").removeClass("no-display").show();
            $(".p-modifiers-select[name=modifiers_"+i+"]").val($(".p-modifiers-select[name=modifiers_"+i+"] option:not(.no-display):contains('"+t+"')").val());
        }
        s = s[m][v];
    })).done(function(){
        onCaclulate(p);
    });
};
window.onInitCalc = function(itm,s){
    console.debug("selected cell",itm);
    var currentChange=function(itm){
        for(var j in f_c_fields){
            console.debug(f_c_fields[j],itm.f_c);
            $.when($(".p-modifiers-select[name=modifiers_"+f_c_fields[j]+"]").val($(".p-modifiers-select[name=modifiers_"+f_c_fields[j]+"] option:not(.no-display):contains('"+itm.f_c+"')").val()).change()).done(function(){
                for(var i in q_fields){
                    //console.debug(q_fields[i],itm.q);
                    $.when($(".p-modifiers-select[name=modifiers_"+q_fields[i]+"] option").each(function(){
                        $(this).text($(this).text().replace(/\s*(\d+).*/ig, "$1").replace(/\D+/ig, "")+" шт.");
                    })).done(function(){
                        var qty = itm.q;//.replace(/(\d+).*/,"$1");
                        $(".p-modifiers-select[name=modifiers_"+q_fields[i]+"]").val($(".p-modifiers-select[name=modifiers_"+q_fields[i]+"] option:not(.no-display):contains('"+qty+"')").val()).change();
                    });

                }
            });
        }
    };
    if($("#p-tabs").length){
        var id = $("#p-tabs").attr("data-id"),val = $("#p-tabs").attr("data-val");
        if(id&&val){
            $.when($(".p-modifiers-select[name=modifiers_"+id+"] option[value="+val+"]").attr("selected","selected").change()).done(currentChange(itm));
        }
    }else currentChange(itm);
};
window.onCaclulate = function (p){
    var total = p,quantity = 0;
    $(".p-modifiers-select option:selected").each(function(){
        var adds =$(this).attr("price");
        if(typeof adds!="undefined" && adds!=false){
            //console.debug(total+"+("+adds+") of "+$(this).text());
            adds = parseFloat(adds);
            total+= adds;
        }
    });
    for(var i in q_fields){

        if(typeof($(".p-modifiers-select[name=modifiers_"+q_fields[i]+"] option:selected").text())!="undefined" && $(".p-modifiers-select[name=modifiers_"+q_fields[i]+"] option:selected").text().length){
            quantity = parseInt($(".p-modifiers-select[name=modifiers_"+q_fields[i]+"] option:selected").text().replace(/\D+/ig,""));
        }
    }
    console.debug("price="+total+" quantity="+quantity);
    total *=quantity;
    if (!isNaN(total)) {
        $("input[name=item_qty]").val(quantity);
        $("#p_total_price").text(priceNumber(total.toFixed(2)));
    }
};
