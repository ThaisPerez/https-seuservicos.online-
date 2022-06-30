

        <script src="js/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

        <script src="vendor/tinymce/tinymce/tinymce.min.js"></script>
        <script src="js/jquery.mask.min.js"></script>
        <script src="js/maskbrphone.js"></script>
        <script src="js/scripts.js"></script>

        <script>
            var useDarkMode = false;

            tinymce.init({
            selector: 'textarea.textarea',
            language: 'pt_BR',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'Minha página', value: 'uploads/tinymce' }
            ],
            image_list: [
                { title: 'Minha página', value: 'uploads/tinymce' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 300,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

            jQuery('document').ready(function() {
                // Limpar alertas no modal de avaliação
                jQuery('#add_review').click(function() {
                    jQuery('.retorno_inserir_avaliacao .alert').remove();
                    jQuery('#comentario').val('');
                    jQuery('.ultimo').prop('checked', true);
                });
                
                // Cadastrar avaliação
                jQuery('#enviar-avaliacao').submit(function(e) {
                    e.preventDefault();

                    jQuery('.retorno_inserir_avaliacao .alert').remove();

                    let id = jQuery('#id').val();
                    let nota = jQuery('input[type=radio]:checked').val();
                    
                    if ( id > 0 && nota > 0 && nota < 6 ) {
                        jQuery.ajax({
                            url: './acaoavaliar.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id,
                                nota: nota,
                                comentario: jQuery('#comentario').val()
                            },
                            success: function(response) {
                                let html = `<div class="alert alert-${response.type}" role="alert">`;
                                html += response.message;
                                html += '</div>';

                                jQuery('.retorno_inserir_avaliacao').html(html);

                                if ( response.type == 'success' ) {
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);
                                }
                            }
                        });
                    }

                    return false;
                });

                // Estrela de avaliação
                jQuery("#media_total_avaliacoes").each( function(index, val) { 
                    let rating = jQuery(this).data("rating");
                    
                    jQuery(this).css('width', (rating * 3) + 'px');
                });
            });
        </script>
    </body>
</html>
<html>
<head>
<style>
footer {
   
 position: fixed;
    bottom: 0;
    left:0;
    width:100%;
    height: 90px;
    width:100%;
   text-align: center;
    padding: 35px;
   background-color: #6c757d;
   color:Black;
}
.container {
    padding-bottom: 3rem;
}
</style>
</head>
<main class="container">

<body>

<footer>
  <p>Desenvolvido por Thais Perez<br>
</footer>