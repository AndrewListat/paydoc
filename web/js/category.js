/**
 * Created by Listat on 27.02.2017.
 */


$(document).ready(function() {

    console.log($('#update_prod').val());
    if (typeof update_prod == 'undefined'){
        // console.log('update_prod', update_prod);
        $.getJSON('/api/get_category1',function (data) {
            $('#tree').treeview({data: data});
        })
    } else {
        console.log('update_prod', update_prod);
        $.getJSON('/api/get_category1?select_id='+update_prod,function (data) {
            console.log(data);
            $('#tree').treeview({data: data,levels: 5});
        })
    }


    // $('#tree').treeview({data: getTree()});

    $('#product-group').on('change', function() {
        if (this.value == '0'){
            $('#tree_cat').hide();
            $('#product-parent_id').val(0);
        }else {
            $('#tree_cat').show();
        }
    });

    $(document).on('click','.node-tree',function () {
        console.log( $('#tree').treeview('getSelected'));
        var select_el = $('#tree').treeview('getSelected');
        if (select_el.length){
            console.log('ok',select_el[0].cat_id);
            console.log('ok')
            $('#product-parent_id').val(select_el[0].cat_id);
        }else{
            $('#product-parent_id').val(null);
            console.log('err')
        }
    });

});

function select_cat() {
    var select_el = $('#tree').treeview('getSelected');
    if (select_el.length){
        console.log('ok',select_el[0].cat_id);
        console.log('ok')
        $('#product-parent_id').val(select_el[0].cat_id);
    }else{
        $('#product-parent_id').val(null);
        console.log('err')
    }
}

function loadCategory() {
    $.getJSON('/api/get_category',function (data) {
        $('#tree').treeview({data: data});
    })
}

function getTree() {

    var res;
    // $.get('/api/get_category',function (data) {
    //     console.log('category',typeof data);
    //     res = [{text:"Главная"},{text:"Главная1"}];
    // });
    // console.log(res);
    // return res;
    return [
        {
            text: "Parent 1",
            nodes: [
                {
                    text: "Child 1",
                    nodes: [
                        {
                            text: "Grandchild 1"
                        },
                        {
                            text: "Grandchild 2"
                        }
                    ]
                },
                {
                    text: "Child 2"
                }
            ]
        },
        {
            text: "Parent 2"
        },
        {
            text: "Parent 3"
        },
        {
            text: "Parent 4"
        },
        {
            text: "Node 1",
            cat_id: 0,
            nodeId: 1,
            selectedIcon: "glyphicon glyphicon-check",
            icon: "glyphicon glyphicon-unchecked",
            color: "#000000",
            state: {
                // checked: true,
                // disabled: true,
                // expanded: true,
                // selected: true
            }
        }
    ];
}