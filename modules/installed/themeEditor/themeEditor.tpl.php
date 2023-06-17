<?php

/**
* This module allows you to edit the Gangster Legends default template
*
* @package Theme Editor
* @author Chris Day
* @version 1.0.0
*/

    function _implode ($arr) {
        if (is_array($arr)) return implode(",", $arr);
        return $arr;
    }


   class themeEditorTemplate extends template {

        public $export = '
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
                            <div>
                                Import / Export
                            </div>
                            <a href="?page=admin&module=themeEditor&action=export&get=true" target="_blank" class="btn btn-primary float-end btn-sm">
                                Export Theme Settings
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <strong>Import Theme Settings</strong>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="settings" />
                                </div>
                                <button class="btn btn-primary">
                                    Upload Settings
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                </div>
            </div>
        ';

        public $login = '
            <form method="post" action="?page=admin&module=themeEditor&action=login">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Page Layout
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Bootstrap Theme</label>
                                    <select class="form-control" name="bootstrap" data-value="{bootstrap}">
                                        <option>default</option>
                                    	<optgroup label="Dark Themes">
        	                                <option value="cyborg">Cyborg</option>
        	                                <option value="darkly">Darkly</option>
                                        	<option value="slate">Slate</option>
        	                                <option value="superhero">Superhero</option>
                                    	</optgroup>
                                    	<optgroup label="Light Themes">
        	                                <option value="cerulean">Cerulean</option>
        	                                <option value="cosmo">Cosmo</option>
        	                                <option value="flatly">Flatly</option>
        	                                <option value="journal">Journal</option>
        	                                <option value="lumen">Lumen</option>
        	                                <option value="readable">Readable</option>
        	                                <option value="sandstone">Sandstone</option>
        	                                <option value="simplex">Simplex</option>
        	                                <option value="spacelab">Spacelab</option>
        	                                <option value="united">United</option>
        	                                <option value="paper">Paper</option>
                                        	<option value="yeti">Yeti</option>
                                    	</optgroup>
                                    </select>
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Page Width</label>
                                    <select class="form-control" name="layoutContainer" data-value="{layoutContainer}">
                                    	<option value="container">Fixed Width</option>
                                    	<option value="container-fluid">Dynamic Width</option>
                                    </select>
                                </p>
                                <p class="m-0">
                                    <label class="fw-bold mb-1">Sidebar Width</label>
                                    <input type="text" class="form-control" name="sidebarWidth" value="{sidebarWidth}">
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Background
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Background Color</label>
                                    <input type="text" class="form-control" name="backgroundColor" value="{backgroundColor}">
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Background Image Repeat</label>
                                    <select class="form-control" name="backgroundRepeat" data-value="{backgroundRepeat}">
                                        <option value="background-no-repeat">No Repeat</option>
                                        <option value="background-repeat">Repeat X + Y</option>
                                        <option value="background-repeat-x">Repeat X</option>
                                        <option value="background-repeat-y">Repeat Y</option>
                                    </select>
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <label class="fw-bold mb-1">Background Image Size</label>
                                            <select class="form-control" name="backgroundSize" data-value="{backgroundSize}">
                                                <option value="background-size-auto">Auto</option>
                                                <option value="background-size-contain">Contain</option>
                                                <option value="background-size-cover">Cover</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="fw-bold mb-1">Background Position</label>
                                            <select class="form-control" name="backgroundPosition" data-value="{backgroundPosition}">
                                                <optgroup label="Top">
                                                    <option value="background-pos-tl">Left</option>
                                                    <option value="background-pos-tc">Center</option>
                                                    <option value="background-pos-tr">Right</option>
                                                </optgroup>
                                                <optgroup label="Center">
                                                    <option value="background-pos-cl">Left</option>
                                                    <option value="background-pos-c">Center</option>
                                                    <option value="background-pos-cr">Right</option>
                                                </optgroup>
                                                <optgroup label="Bottom">
                                                    <option value="background-pos-bl">Left</option>
                                                    <option value="background-pos-bc">Center</option>
                                                    <option value="background-pos-br">Right</option>
                                                </optgroup>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <p class="m-0">
                                    <label class="fw-bold mb-1">Background Image URL</label>
                                    <input type="text" class="form-control" name="backgroundURL" value="{backgroundURL}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Menus
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Menu Location</label>
                                    <select class="form-control" name="menuPosition" data-value="{menuPosition}">
                                        <option value="top">Top of page</option>
                                        <option value="left">Left Sidebar</option>
                                        <option value="right">Right Sidebar</option>
                                    </select>
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Logo URL</label>
                                    <input type="text" class="form-control" name="logoURL" value="{logoURL}">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        custom CSS
                    </div>
                    <textarea data-code-editor="css" class="form-control" rows="8" name="customCSS">{customCSS}</textarea>
                </div>


                <div class="text-end">
                    <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
        ';

        public $layout = '
            <form method="post" action="?page=admin&module=themeEditor&action=layout">
                <div class="row">
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Page Layout
                            </div>
                            <div class="card-body">
                                    <label class="fw-bold mb-1">Bootstrap Theme</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <select class="form-control" name="bootstrap" data-value="{bootstrap}">
                                                    <option>default</option>
                                                    <option value="cerulean">Cerulean</option>
                                                    <option value="cosmo">Cosmo</option>
                                                    <option value="cyborg">Cyborg</option>
                                                    <option value="darkly">Darkly</option>
                                                    <option value="flatly">Flatly</option>
                                                    <option value="journal">Journal</option>
                                                    <option value="litera">Litera</option>
                                                    <option value="lumen">Lumen</option>
                                                    <option value="lux">Lux</option>
                                                    <option value="materia">Materia</option>
                                                    <option value="minty">Minty</option>
                                                    <option value="morph">Morph</option>
                                                    <option value="pulse">Pulse</option>
                                                    <option value="quartz">Quartz</option>
                                                    <option value="sandstone">Aandstone</option>
                                                    <option value="simplex">Simplex</option>
                                                    <option value="sketchy">Sketchy</option>
                                                    <option value="slate">Slate</option>
                                                    <option value="solar">Solar</option>
                                                    <option value="spacelab">Spacelab</option>
                                                    <option value="superhero">Superhero</option>
                                                    <option value="united">United</option>
                                                    <option value="vapor">Vapor</option>
                                                    <option value="yeti">Yeti</option>
                                                    <option value="zephyr">Zephyr</option>
                                                </select>
                                            </p>    
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <select class="form-control" name="bootstrapTheme" data-value="{bootstrapTheme}">
                                                    <option value="dark">Dark Mode</option>
                                                    <option value="light">Light Mode</option>
                                                </select>
                                            </p>    
                                        </div>    
                                    </div>    
                                <p>
                                    <label class="fw-bold mb-1">Page Width</label>
                                    <select class="form-control" name="layoutContainer" data-value="{layoutContainer}">
                                        <option value="container">Fixed Width</option>
                                        <option value="container-fluid">Dynamic Width</option>
                                    </select>
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Sidebar Width</label>
                                    <input type="text" class="form-control" name="sidebarWidth" value="{sidebarWidth}">
                                </p>
                                <div class="p">
                                    <label class="fw-bold mb-1">Shoutbox Width (0 to disable)</label>
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control" name="shoutbox" value="{shoutbox}">
                                        <span class="input-group-text">px</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Background
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Background Color</label>
                                    <input type="color" class="form-control form-control-color" name="backgroundColor" value="{backgroundColor}" style="width: 100%"">
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Background Image Repeat</label>
                                    <select class="form-control" name="backgroundRepeat" data-value="{backgroundRepeat}">
                                        <option value="background-no-repeat">No Repeat</option>
                                        <option value="background-repeat">Repeat X + Y</option>
                                        <option value="background-repeat-x">Repeat X</option>
                                        <option value="background-repeat-y">Repeat Y</option>
                                    </select>
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <label class="fw-bold mb-1">Background Image Size</label>
                                            <select class="form-control" name="backgroundSize" data-value="{backgroundSize}">
                                                <option value="background-size-auto">Auto</option>
                                                <option value="background-size-contain">Contain</option>
                                                <option value="background-size-cover">Cover</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="fw-bold mb-1">Background Position</label>
                                            <select class="form-control" name="backgroundPosition" data-value="{backgroundPosition}">
                                                <optgroup label="Top">
                                                    <option value="background-pos-tl">Left</option>
                                                    <option value="background-pos-tc">Center</option>
                                                    <option value="background-pos-tr">Right</option>
                                                </optgroup>
                                                <optgroup label="Center">
                                                    <option value="background-pos-cl">Left</option>
                                                    <option value="background-pos-c">Center</option>
                                                    <option value="background-pos-cr">Right</option>
                                                </optgroup>
                                                <optgroup label="Bottom">
                                                    <option value="background-pos-bl">Left</option>
                                                    <option value="background-pos-bc">Center</option>
                                                    <option value="background-pos-br">Right</option>
                                                </optgroup>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <p class="m-0">
                                    <label class="fw-bold mb-1">Background Image URL</label>
                                    <input type="text" class="form-control" name="backgroundURL" value="{backgroundURL}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Sidebars
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Left Sidebar Menus</label>
                                    <select type="text" class="form-control" name="sidebarLeft[]" data-values="{_implode sidebarLeft}" multiple>
                                        {#each _sidebars}
                                            <option value="{id}">{title}</option>
                                        {/each}
                                    </select>
                                </p>

                                <p>
                                    <label class="fw-bold mb-1">Right Sidebar Menus</label>
                                    <select type="text" class="form-control" name="sidebarRight[]" data-values="{_implode sidebarRight}" multiple>
                                        {#each _sidebars}
                                            <option value="{id}">{title}</option>
                                        {/each}
                                    </select>
                                </p>

                                <p>
                                    <label class="fw-bold mb-1">User Information Position</label>
                                    <select class="form-control" name="userInfoPosition" data-value="{userInfoPosition}">
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Navigation
                            </div>
                            <div class="card-body">
                                <p>
                                    <label class="fw-bold mb-1">Padding</label>
                                    <select class="form-control" name="navigationPadding" data-value="{navigationPadding}">
                                        <option value="0">0 - None</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option value="5">5 - Large</option>
                                    </select>
                                </p>
                                <p>
                                    <label class="fw-bold mb-1">Heading Color</label>
                                    <select class="form-control" name="navigationHeadingColor" data-value="{navigationHeadingColor}">
                                        <option value="primary">Primary</option>
                                        <option value="secondary">Secondary</option>
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="warning">Warning</option>
                                        <option value="info">Info</option>
                                        <option value="light">Light</option>
                                        <option value="dark">Dark</option>
                                    </select>
                                </p>


                                <div class="p">
                                    <label class="fw-bold mb-1">Font Size</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="navigationFontSize" value="{navigationFontSize}">
                                        <span class="input-group-text">px</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Custom CSS
                    </div>
                    <textarea data-code-editor="css" class="form-control" rows="8" name="customCSS">{customCSS}</textarea>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
        ';

    }