import tinymce from "tinymce";
import tinyUpload from "./tiny-upload";

// theme
import 'tinymce/themes/silver';

// model
import 'tinymce/models/dom';

//icons
import 'tinymce/icons/default';

// plugins
import 'tinymce/plugins/lists';
import 'tinymce/plugins/image';
import 'tinymce/plugins/code';
import 'tinymce/plugins/link';

// skin
import 'tinymce/skins/ui/oxide-dark/skin';
import 'tinymce/skins/content/dark/content'
import 'tinymce/skins/ui/oxide-dark/content';

window.tinymce = tinymce;
window.tinyUpload = tinyUpload;