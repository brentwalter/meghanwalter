<?php
    if (isset($_GET['page']) && $_GET['page']=='pixgridder_descdoc') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Documentation','pixgridder'); ?>: <small><?php _e('Description','pixgridder'); ?></small></h3>

            <h4>A grid builder</h4>

            <p>
                <strong>First of all, thank you for your purchase!</strong> ...and excuse me for my poor English.<br>
            </p>
            <p>
                I prefer to define this plugin as a <strong>&quot;grid builder&quot;</strong> instead of a page builder, because a page builder is commonly intended as a tool that allows to create sections and, usually, comes with shortcodes such as tabs, accordions, particular sections, galleries etc... And, in many cases, all these shortcodes are not compatible with other similar plugins you prefer to use.
            </p>
            <p>
                <strong>PixGridder</strong> is instead very simple, because it only allows to split your page (or post or custom post, you can decided it) in rows and columns, simply <strong>by moving the functions</strong> available on your tinyMCE editor from the whole page to each columns you decide to split your page in. In this way you can use the plugins you prefer with the shortcodes you prefer (and also the buttons available on your tinyMCE editor) since the editor it is <strong>exactly the same</strong> you would have without using PixGridder.
            </p>

            <h4>How it works</h4>

            <p>
                <strong>PixGridder</strong> doesn't generate shortcodes, it only puts into your posts and pages some html comments like this<br>
                <code>&lt;!--pixgridder:row[cols=3]--&gt;</code><br>
                <strong>invisible except through the source code</strong>. So if you want to disable the plugin you don't have to worry about a lot of strange and unuseful shortcodes across your content because everything will stay hidden to the search engine robots too.
            </p>

            <p>
                However, if you want to remove any trace of the plugin from the source code, you can do it by enabling the <strong>&quot;no trace&quot;</strong> option, so, when you delete the plugin from your plugin list, all the options and all the comments related to it will be removed, but you'll keep unaltered your content.
            </p>

            <p>&nbsp;</p>

        </section><!-- #pix_content_loaded -->
<?php 
    } elseif (isset($_GET['page']) && $_GET['page']=='pixgridder_startdoc') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Documentation','pixgridder'); ?>: <small><?php _e('Installation','pixgridder'); ?></small></h3>

            <h4>Installation</h4>

            <p>
                The file you downloaded from CodeCanyon contains a folder called <strong>&quot;pixgridder&quot;</strong> and a zip file called <strong>&quot;pixgridder.zip&quot;</strong>.<br>
                Once you downloaded PixGridder on your computer, you have two options to install it:
            </p>

            <ol>
                <li>by using an FTP client (FileZilla, Dreamweaver, FireFTP, Transmit or similar) upload the &quot;pixgridder&quot; folder to <code>your_root / wp-content / plugins</code></li>
                <li>directly from the Wordpress administration, go to <strong>&quot;Plugins &rarr; Add new &rarr; Upload&quot;</strong> and upload the file &quot;pixgridder.zip&quot;</li>
            </ol>

            <p>
                In both cases, once you uploaded the plugin, activate it from the list of plugins.
            </p>

            <p>&nbsp;</p>

        </section><!-- #pix_content_loaded -->
<?php 
    } elseif (isset($_GET['page']) && $_GET['page']=='pixgridder_admindoc') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Documentation','pixgridder'); ?>: <small><?php _e('Admin panel','pixgridder'); ?></small></h3>

            <h4>Very general</h4>

            <p>
                On this section you can decide to <strong>enable AJAX</strong> to save the data. This option is already enabled by default, since using AJAX to save data allows to not reload the page each time you click the &quot;Save options&quot; button and, for this reason, it makes you save time.<br>
                But if you encounter any problem (maybe a conflict with another plugin or with a setting of your server) just switch this checkbox off.
            </p>

            <p>
                <img src="<?php echo PIXGRIDDER_URL; ?>lib/admin/docs/plugin-delete.png" class="alignleft" width="178" height="57" alt="Delete a plugin">The other checkbox available on this page allows you to <strong>remove any trace</strong> of the plugin after unistalling it. With &quot;uninstall&quot; I mean deactivate it and deleting it by using the red link &quot;Delete&quot; that appears below the disabled plugin, like in the image on the left.
            </p>
            <p>
                This feature, if enabled, will remove all the options created by the PixGridder and saved in the database and also all the html comments that generates the rows and the columns from the posts/pages (from the published posts and pages only, not from the revisions or the auto-saved ones).
            </p>
            <p>
                <em><strong>N.B.:</strong> since this option manages your database, I recommend to run it only if strictly necessary and after making a backup of your database itself, if possible. It haven't had any problem during the beta testing, but as many backups as you can are always recommended in these cases.</em>
            </p>

            <h4>Register</h4>

            <p>
                Since <strong>PixGridder 1.0.1</strong>, is available the automatic update for the plugin, just follow the instructions available on this section: enter the details of your purchase (your CodeCanyon username and your purchaser license code... screenshot about that are available on the admin panel itself).
            </p>
            <p>
                After entering the details and saving, you should receive a &quot;Success&quot; message: now you'll be notified when a new version of the plugin is available and you'll be able to update directly from your WP dashboard.
            </p>
            <p>
                The automatic update is intended for the regular licenses only and it allows until <strong>5 installations</strong> (I imagined beta test sites and some domain changes etc.). For questions regarding extended licenses or any issues contact me on <a href="http://codecanyon.net/user/pixedelic" target="_blank">CodeCanyon</a><br>
                <strong>N.B.:</strong> the notifier works only with the plugin activated.
            </p>

            <h4>Settings</h4>

            <p>
                On this page, first of all, you can select the default <strong>effect</strong> to apply to your columns on <strong>scroll event</strong>. Ten options are avalable:
            </p>

            <ol>
                <li>
                    <strong>none:</strong> no effect will be applied <strong>and you can't</strong> override this option from the grid builder interface
                </li>
                <li>
                    <strong>available:</strong> no effect will be applied <strong>but you can</strong> override this option from the grid builder interface 
                </li>
                <li>
                    <strong>pix-fadeIn:</strong> a fade-in effect will be applied (the fade-in is included into all the other effects too)
                </li>
                <li>
                    <strong>pix-fadeDown:</strong> the element will appear on scroll event from the bottom
                </li>
                <li>
                    <strong>pix-fadeUp:</strong> the element will appear on scroll event from the top
                </li>
                <li>
                    <strong>pix-fadeLeft:</strong> the element will appear on scroll event from the left
                </li>
                <li>
                    <strong>pix-fadeRight:</strong> the element will appear on scroll event from the right
                </li>
                <li>
                    <strong>pix-zoomIn:</strong> the element will appear by zooming in
                </li>
                <li>
                    <strong>pix-zoomOut:</strong> the element will appear by zooming out
                </li>
                <li>
                    <strong>pix-rotateIn:</strong> the element will appear by rotating from the left
                </li>
                <li>
                    <strong>pix-rotateOut:</strong> the element will appear by rotating from the right
                </li>
                <li>
                    <strong>pix-flipClock:</strong> the element will appear with a 3D effect looking like flip clocks
                </li>
                <li>
                    <strong>pix-swing:</strong> the element will appear with a swinging 3D effect
                </li>
                <li>
                    <strong>pix-turnForward:</strong> the element will appear with a turning page 3D effect
                </li>
                <li>
                    <strong>pix-turnBackward:</strong> the element will appear with a turning page 3D effect
                </li>
            </ol>

            <p>
                You can also override these effect by typing one of these values (actually they are CSS classes, nothing else) into the CSS editor available for each column inside the grid builder UI.
            </p>

            <p>
                You can also select the post types you want to apply the grid builder to (only those for which the editor is available). By default <strong>the pages are enabled</strong>. Besides the generic post type &quot;page&quot;, you can enable or disable the <strong>page templates</strong> you want to apply or not apply the default options of the grid builder to.<br>
                You'll apply the options set on this page itself to the selected post types, but on the section <strong><em>&quot;Add rules&quot;</em></strong> you'll be able to apply other particular rules, so I recommend to take a look to that section too.
            </p>

            <p>
                You can also decide the minimum and maximum of allowed columns by dragging some <strong>useful sliders</strong> and also typing the number of columns not allowed. It means that by selecting as maximum value <strong>&quot;12&quot;</strong> you won't create a simple 12-column grid, as for Bootstrap or similar, because you'll be able to have a section with a number of columns of the same width not allowed in a normal 12 column grid: 11 columns, 7 columns, 5 colums etc.<br>
            </p>

            <p>
                You can also decide here the code the html comments will be replace with on your frontend. By default the comments are replaced by DIVs with the classes <code>row</code> and <code>columns</code> and the <code>data-</code> attributes <code>data-cols="$1"</code> for the rows and <code>data-col="$1"</code> for the columns, where the signs <code>$1</code> is the number of columns allowed for the rows and the column width for the columns.<br>
                The CSS compiler available on the section <strong><em>&quot;Compile CSS file&quot;</em></strong> is based on these default values. If you change them the code generated by the CSS compiler won't work anymore for your code and you'll have to create it with your preferite editor. However more info are available below. 
            </p>

            <h4>Compile CSS file</h4>

            <p>
                On this section you can set the <strong>CSS selector</strong> the JS plugin will use to run the effects on scroll event. By default the element the effects are applied to is <code>.row .column</code>, but you can decide to add other elements or replace the dafault one.
            </p>

            <p>
                Also the <strong>duration of the effects</strong> can be set in this section. To make the animations a little smoother, the fade-in effect is combined by default to all the other effects too and, for the same reason, its duration is set a little longer.
            </p>

            <p>
                You can also set the <strong>gutter width and height</strong> of your grid. These values are expressed in percentages, as well as for the <strong>padding</strong> of your columns.
            </p>

            <p>
                The <strong>breakpoint</strong> is expressed in pixels and it indicates the size of the screen under which all your column widths become 100%. By default is <strong>768</strong>, the width of an iPad monitor on portrait view.
            </p>

            <p>
                Unfortunately a CSS compiler that generated a more complex CSS was impossible, so if you need more breakpoints or a different approach I can only recommend to use the <strong>CSS editor</strong> you can find on this page, disable the field <strong>&quot;Include the generated CSS into your compile file&quot;</strong> and compile your CSS file without the automatic generated part by using the buttons <strong>&quot;Compile and download&quot;</strong> and <strong>&quot;Save, compile and push&quot;</strong>.<br>
            </p>

            <p>
                The function of these two buttons is well explained on the buttons themselves. The first one <strong>compiles your CSS file and it makes it available for downloading</strong>. Once downloaded, you can upload it to your server as you prefer, but <em><strong>remember:</strong></em> the plugin searches for a file called <strong>gridder.css</strong> on your theme folder, if it can find it that file will override the default one available in the plugin directory. So if you want to run your own CSS code, you don't need to amend the default CSS file or add some lines of code to the main stylesheet of your theme, but simply upload a file called <strong>gridder.css</strong> to your theme directory and PixGridder will load it automatically.
            </p>

            <p>
                By clicking the second button, <strong>&quot;Save, compile and push&quot;</strong>, you save the options on this page, you compile the CSS file and, most of all, you upload it to your theme folder, so you will overwrite the file called <strong>gridder.css</strong>, if already available on your theme directory. The uploading uses the Wordpress APIs and not all the servers allow it. For some servers are also required your FTP details.<br>
                As I said for the previous button, the plugin searches for a file called <strong>gridder.css</strong> on your theme folder, if it can find it that file will override the default one available in the plugin directory. So if you want to run your own CSS code, you don't need to amend the default CSS file or add some lines of code to the main stylesheet of your theme, but simply compile and push your CSS rules through this button.
            </p>

            <h4>Add rules</h4>

            <p>
                If you need to run some extra rules, if you are not satisfied by the default options for a particular post type (for instance: you have a &quot;slideshow&quot; post type or use custom post types to display tabs and accordions, and in this case maybe a section with one column only is necessary), you can add <strong>some rules that override the default ones</strong>. 
            </p>

            <p>
                In this section you can set your extra rules: click <strong>&quot;Add a new rule&quot;</strong> button to create an empty box. Than click the &quot;pencil&quot; icon to edit the box and add your rules. The box displays a preview of your options with some fields visible only. But the dialog box will allow to edit:
            </p>

            <ul>
                <li>
                    the <strong>&quot;Post type&quot;</strong> the rule will be applied to
                </li>
                <li>
                    the <strong>&quot;Post meta name&quot;</strong> present in the post type itself (you have to name the name of the post meta field available in that particular post type, for instance, for the select box that allows you to select the page template, the name is <strong>_wp_page_template</strong>)
                </li>
                <li>
                    the <strong>&quot;Post meta value&quot;</strong>: so you added a meta-box to your post type you can run this rule if the meta-box has got a particular value only
                </li>
                <li>
                    you can decide to <strong>disable</strong> or enable the page builder in particular conditions, set by the extra rules
                </li>
                <li>
                    you can also decide different values for the <strong>html comments replacement</strong> feature
                </li>
                <li>
                    and of course you can set a <strong>different number of columns</strong> by using the extra rules
                </li>
            </ul>

            <p>&nbsp;</p>

        </section><!-- #pix_content_loaded -->
<?php 
    } elseif (isset($_GET['page']) && $_GET['page']=='pixgridder_builderdoc') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Documentation','pixgridder'); ?>: <small><?php _e('Grid builder','pixgridder'); ?></small></h3>

            <p>
                <img src="<?php echo PIXGRIDDER_URL; ?>lib/admin/docs/gridder-explanation.png" alt="The grid builder">
            </p>

            <ol>
                <li>
                    <strong>title</strong> and <strong>version</strong> of the installed plugin                                            
                </li>
                <li>
                    <strong>Preview tab:</strong> by clicking it you will see the live site with a preview of the changes, not editable from the preview visual itself
                </li>
                <li>
                    <strong>Builder tab:</strong> where you can edit your page/post by using the grid builder
                </li>
                <li>
                    <strong>row dragger:</strong> use it to sort your rows and move them to the top or to the bottom
                </li>
                <li>
                    <strong>ID and class:</strong> use it to open a dialog box where to add an ID or a class to your row
                </li>
                <li>
                    <strong>clone button:</strong> clone your entire row and append the clone below the original one (everything will be cloned, cloumns, IDs, classes etc.)
                </li>
                <li>
                    <strong>column select:</strong> select how many columns your row is based on
                </li>
                <li>
                    <strong>delete:</strong> remove the row
                </li>
                <li>
                    <strong>alert icon:</strong> this icon will appear when you make a not-allowed operation, such as adding a column where there is no space for other columns or try to reduce the width of column if it already has got the minimum width allowed
                </li>
                <li>
                    <strong>add row:</strong> click to add an empty row
                </li>
                <li>
                    <strong>add column:</strong> click to add an empty column
                </li>
                <li>
                    <strong>column dragger:</strong> use it to sort your columns and move them to the left or to the right inside a row
                </li>
                <li>
                    <strong>column content:</strong> here is displayed a preview of the content (the font and the text color won't reflect on the frontend)
                </li>
                <li>
                    <strong>expand column:</strong> click to increase the width of the column
                </li>
                <li>
                    <strong>contract column:</strong> click to reduce the width of the column
                </li>
                <li>
                    <strong>edit column:</strong> click to open a dialog box where to edit the content of the column (a tinyMCE editor will open in the dialog box, the width of the textarea will be relative to the max width set for the theme you're using and the width of the column you're editing)
                </li>
                <li>
                    <strong>clone button:</strong> clone your entire column and append the clone to the right of the original one, if there is enough space (everything will be cloned, content, ID, class etc.)
                </li>
                <li>
                    <strong>ID and class:</strong> use it to open a dialog box where to add an ID or a class to your column
                </li>
                <li>
                    <strong>delete:</strong> remove the column
                </li>
                <li>
                    <strong>&quot;Disable the grid builder&quot;:</strong> tick the checkbox and update the page &rarr; now the page is editable without using the grid builder, but the frontend still displays columns and rows, so pay attention to not remove any html comment or you risk to break the layout
                </li>
                <li>
                    <strong>&quot;Remove any trace of PixGridder from this page&quot;:</strong> tick the checkbox and update the page &rarr; all the row and the columns will be removed but without touching the content, still available both on the frontend and on the editor
                </li>
            </ol>

            <p>&nbsp;</p>

        </section><!-- #pix_content_loaded -->
<?php 
    }