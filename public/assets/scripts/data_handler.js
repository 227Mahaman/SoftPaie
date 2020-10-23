host = $(location).attr('hostname');
protocol = $(location).attr('protocol');
folder = '';
if (host == 'localhost') {
    folder = '/slim3';
}
myurl= "http://localhost/slim3/index.php/";
//myurl = protocol + '//' + host + folder + '/api/object/';
//Recuperer les données enget
var $_GET = {};
document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});
// getPermission();
$('input:checkbox.module_is_checked').each(function (i, v) {
    $mr = getDataWith2Param('profil_has_action', 'id_action', $(v).val(), 'id_profil', $_GET['role']);

    $mr.done(function ($mr) {
        console.log($mr, "res");
        if ($mr.length!=0) {//Si le menu existe pour le profil
            $(v).attr('checked', true);
        }
    });

    $mr.fail(function ($mr) {
        $(v).attr('checked', false);

    });
});




function addPermissionRole(chec) {
    $data = "id_typeuser=" + $_GET['role'] + "&id_action=" + $(chec).val();
    //$data = JSON.stringify($($data).serializeObject());
    $mr = getDataWith2Param('profil_has_action', 'id_action', $(chec).val(), 'id_typeuser', $_GET['role']);
    console.log($data, $mr, "ci");
    if ($(chec).prop('checked') == true) {
        $mr.done(function ($mr) {
            if ($mr.error) {
                console.log($mr, $mr.error);
                $.ajax({
                    url: myurl + "profil_has_action",
                    type: "POST",
                    contentType: 'application/json',
                    dataType: "json",
                    data: $data,
                    success: function (result) {
                        console.log(result);
                    },
                    error: function (xhr, resp, text) {
                        // show error to console
                        console.log(xhr, resp, text);
                    }
                });
            }
        });

        $mr.fail(function ($mr) {
            console.log($mr, $mr.error);
            $.ajax({
                url: myurl + "profil_has_action",
                type: "POST",
                contentType: 'application/json',
                dataType: "json",
                data: $data,
                success: function (result) {
                    console.log(result);
                },
                error: function (xhr, resp, text) {
                    // show error to console
                    console.log(xhr, resp, text);
                }
            });
        });
    } else {
        deleteDataWith2Param('profil_has_action', 'id_action', $(chec).val(), 'id_typeuser', $_GET['role']);
    }
}

// $('#bureau').selectize({
//     create: true,
//     sortField: {
//         field: 'text',
//         direction: 'asc'
//     },
//     onChange: function (value) {

//     },
//     dropdownParent: 'body'
// });
// filtrage de l'exercice par ville
// $("#bureau").on('change', function (e) {

//     showPleaseWait();
//     val = $(this).val();
//     // console.log("ce bureau", val);

//     // $exercice = getDatas("exercice", "bureau", val);

//     // $exercice.done(function (data) {
//     //     console.log(data, "exercice");
//     //     data = data.data;
//     //     html = "";
//     //     $.each(data, function (i, v) {
//     //         html += '<option value="' + v.id_exercice + '">' + v.libelle + '</option>';
//     //     });
//     //     $("#exercice").html(html);
//     // });
//     $.getJSON("exercice.json", function (data) {
//         html = "";
//         $.each(data, function (i, v) {
//             if (v.bureau == val) {
//                 html += '<option value="' + v.id_exercice + '">' + v.libelle + '</option>';
                
//                 // option += '<li data-value="' + val.id_ville + '" class="option">' + val.intitule + '</li>';
//             }
//             hidePleaseWait();
//         });
//         $("#exercice").html(html);

//     });
//     // $exercice.fail(function ($err) {
//     //     console.log($err, "exercice err");
//     //     html = '<option value="">Ce bureau n\' pas d\'exercice</option>';
//     //     $("#exercice").html(html);
//     //     hidePleaseWait();
//     // });

// });

function getModuleRole() {

}

// function getPermission() {
//     console.log("perm");

//     $permision = getDatas('module', 'sub_module', $_GET['module']);
//     //console.log("module", $permision);

//     $permision.done(function ($permision) {
//         if (!$permision.error) {
//             $data = '';
//             $permision = $permision.data;
//             $.each($permision, function (i, v) {
//                 $data += `
//                 <tr>
//                 <td>` + v.name + `</td>
//                 <td>` + v.description + `</td>
//                 <td>
//                   <a class="btn btn-primary">
//                     <i class="fa fa-edit"></i>
//                   </a>
//                 </td>
//               </tr>
//                 `;
//             });
//             $('#body_permission').html($data);
//         }
//     });


// }

// function setActionUrl(name) {
//     arrName = name.split(' ', 2);
//     name = arrName[0] + "-" + arrName[1];
//     name = name.toLowerCase();
//     return name;
// }

// function addData(table) {
//     var go;
//     var data = $('#add_permission').serializeObject();
//     data.action_url = setActionUrl(data.name);
//     var form_data = JSON.stringify(data);

//     go = canContinue(data);
//     console.log(form_data, $('#add_permission'));
//     if (go) {
//         $.ajax({
//             url: myurl + table,
//             type: "POST",
//             contentType: 'application/json',
//             dataType: "json",
//             data: form_data,
//             success: function (result) {
//                 console.log(result);

//                 getPermission();
//             },
//             error: function (xhr, resp, text) {
//                 //  error to console
//                 console.log(xhr, resp, text);
//             }
//         });
//     }
// }

// function getData(table, field, value) {
//     return $.ajax({
//         url: myurl + table + '/' + field + '/' + value,
//         type: "GET",
//         contentType: 'application/json',
//         dataType: "json",
//         error: function (xhr, resp, text) {
//             // show error to console
//             console.log(xhr, resp, text);
//         }
//     });
// }

// function getDatas(table, field = null, value = null) {
//     console.log(myurl + table + '/' + field + '/' + value + '/?s');

//     if (field != null, value != null) {
//         return $.ajax({
//             url: myurl + table + '/' + field + '/' + value + '/?s',
//             type: "GET",
//             contentType: 'application/json',
//             dataType: "json",
//             error: function (xhr, resp, text) {
//                 // show error to console
//                 console.log(xhr, resp);
//                 console.log(text, "entexte");

//             }
//         });
//     } else {
//         return $.ajax({
//             url: myurl + table,
//             type: "GET",
//             contentType: 'application/json',
//             dataType: "json",
//             error: function (xhr, resp, text) {
//                 // show error to console
//                 console.log(xhr, resp, text);
//             }
//         });
//     }
// }

function getDataWith2Param(table, field, value, $field2, $value2) {
    console.log(myurl + table + '/' + field + '/' + value + '/' + $field2 + '/' + $value2);

    return $.ajax({
        url: myurl + table + '/' + field + '/' + value + "/" + $field2 + "/" + $value2,
        type: "GET",
        contentType: 'application/json',
        dataType: "json",
        error: function (xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
        }
    });
}

// function deleteData(table, field, value) {
//     return $.ajax({
//         url: myurl + table + '/' + field + '/' + value,
//         type: "DELETE",
//         contentType: 'application/json',
//         dataType: "json",
//         error: function (xhr, resp, text) {
//             // show error to console
//             console.log(xhr, resp, text);
//         }
//     });
// }

function deleteDataWith2Param(table, field, value, $field2, $value2) {
    return $.ajax({
        url: myurl + table + '/' + field + '/' + value + "/" + $field2 + "/" + $value2,
        type: "POST",
        contentType: 'application/json',
        dataType: "json",
        error: function (xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
        }
    });
}

// function addTablRow() {
//     $tr = `<tr id="addPermission">
//     <form >
//             <td>
//             <div class="form-group">
//                 <input type="text" required class="form-control" id="name" name="name" placeholder="Le nom du module">
//             </div>
//             </td>
//             <td>
//             <div class="form-group">
//                 <input required class="form-control" id="description" name="description" placeholder="description du module">
//             </div>
//             </td>
//             <td>
//             <button type="button" onclick="addData('action')" class="btn btn-primary">
//                 <i class="fa  fa-check-square"></i>
//                 Valider
//             </button>
//             </td>
//   </tr>`;
//     if (!$("#addPermission").length) {
//         $('#table_permission').append($tr);
//     }
// }

// function canContinue(data) {
//     var go;
//     $.each(data, function (i, valueOfElement) {
//         if (data[i] == '') {
//             go = 'yes';
//             $('#danger_content').text('');
//             $('#danger_content').append('<p>Tout les champs doivent être rensignés</p>');
//             $('#modal-danger').modal('show');
//         }
//     });
//     if (go == 'yes') {
//         return false;
//     } else {
//         return true;
//     }
// }

// function showPleaseWait() {
//     if (document.querySelector("#pleaseWaitDialog") == null) {
//         var modalLoading = `<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">
//         <div class="modal-dialog">
//             <div class="modal-content">
//                 <div class="modal-header">
//                     <h4 class="modal-title">Patientez svp...</h4>
//                 </div>
//                 <div class="modal-body">
//                     <div class="progress">
//                       <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
//                       aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">
//                       </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>`;
//         $(document.body).append(modalLoading);
//     }
//     $("#pleaseWaitDialog").modal("show");
// }

/**
 * Hides "Please wait" overlay. See function showPleaseWait().
 */
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}