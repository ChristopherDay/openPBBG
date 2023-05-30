<?php

/**
* This module allows you to edit the Gangster Legends default template
*
* @package Theme Editor
* @author Chris Day
* @version 1.0.0
*/


   class themeEditorTemplate extends template {

        public $login = '
            <form method="post" action="?page=admin&module=themeEditor&action=login">

            	<h4>Page Layout</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Bootstrap Theme</label>
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
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Page Width</label>
                            <select class="form-control" name="layoutContainer" data-value="{layoutContainer}">
                            	<option value="container">Fixed Width</option>
                            	<option value="container-fluid">Dynamic Width</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Sidebar Width</label>
                            <input type="text" class="form-control" name="sidebarWidth" value="{sidebarWidth}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Shoutbox Width (0 to disable)</label>
                            <div class="input-group" style="width: 100%">
                                <input type="text" class="form-control" name="shoutbox" value="{shoutbox}">
                                <span class="input-group-addon">px</span>
                            </div>

                        </div>
                    </div>
                </div>

                <h4>Background</h4>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Color</label>
                            <input type="text" class="form-control" name="backgroundColor" value="{backgroundColor}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Image Repeat</label>
                            <select class="form-control" name="backgroundRepeat" data-value="{backgroundRepeat}">
                                <option value="background-no-repeat">No Repeat</option>
                                <option value="background-repeat">Repeat X + Y</option>
                                <option value="background-repeat-x">Repeat X</option>
                                <option value="background-repeat-y">Repeat Y</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Image Size</label>
                            <select class="form-control" name="backgroundSize" data-value="{backgroundSize}">
                                <option value="background-size-auto">Auto</option>
                                <option value="background-size-contain">Contain</option>
                                <option value="background-size-cover">Cover</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Position</label>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Background Image URL</label>
                            <input type="text" class="form-control" name="backgroundURL" value="{backgroundURL}">
                        </div>
                    </div>
                </div>

                <h4>Menu</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Menu Location</label>
                            <select class="form-control" name="menuPosition" data-value="{menuPosition}">
                                <option value="top">Top of page</option>
                                <option value="left">Left Sidebar</option>
                                <option value="right">Right Sidebar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="pull-left">Logo URL</label>
                            <input type="text" class="form-control" name="logoURL" value="{logoURL}">
                        </div>
                    </div>
                </div>

                <h4>Custom CSS</h4>
                <p>
                    <textarea class="form-control" rows="8" name="customCSS">{customCSS}</textarea>
                </p>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
        ';

        public $layout = '
            <form method="post" action="?page=admin&module=themeEditor&action=layout">

                <h4>Page Layout</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Bootstrap Theme</label>
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
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Page Width</label>
                            <select class="form-control" name="layoutContainer" data-value="{layoutContainer}">
                                <option value="container">Fixed Width</option>
                                <option value="container-fluid">Dynamic Width</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Sidebar Width</label>
                            <input type="text" class="form-control" name="sidebarWidth" value="{sidebarWidth}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Shoutbox Width (0 to disable)</label>
                            <div class="input-group" style="width: 100%">
                                <input type="text" class="form-control" name="shoutbox" value="{shoutbox}">
                                <span class="input-group-addon">px</span>
                            </div>

                        </div>
                    </div>
                </div>

                <h4>Background</h4>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Color</label>
                            <input type="text" class="form-control" name="backgroundColor" value="{backgroundColor}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Image Repeat</label>
                            <select class="form-control" name="backgroundRepeat" data-value="{backgroundRepeat}">
                                <option value="background-no-repeat">No Repeat</option>
                                <option value="background-repeat">Repeat X + Y</option>
                                <option value="background-repeat-x">Repeat X</option>
                                <option value="background-repeat-y">Repeat Y</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Image Size</label>
                            <select class="form-control" name="backgroundSize" data-value="{backgroundSize}">
                                <option value="background-size-auto">Auto</option>
                                <option value="background-size-contain">Contain</option>
                                <option value="background-size-cover">Cover</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">Background Position</label>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Background Image URL</label>
                            <input type="text" class="form-control" name="backgroundURL" value="{backgroundURL}">
                        </div>
                    </div>
                </div>

                <h4>Sidebars</h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="pull-left">Left Sidebar Menus</label>
                            <input type="text" class="form-control" name="sidebarLeft" value="{sidebarLeft}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="pull-left">Right Sidebar Menus</label>
                            <input type="text" class="form-control" name="sidebarRight" value="{sidebarRight}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="pull-left">User Information Position</label>
                            <select class="form-control" name="userInfoPosition" data-value="{userInfoPosition}">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h4>Custom CSS</h4>
                <p>
                    <textarea class="form-control" rows="8" name="customCSS">{customCSS}</textarea>
                </p>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
        ';

    }