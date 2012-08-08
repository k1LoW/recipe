<?php
$ingredients = array(
                     'debugkit' => array('name' => 'DebugKit',
                                         'description' => 'CakePHP DebugKit',
                                         'author' => 'CakePHP',
                                         'type' => RECIPE_TYPE_PLUGIN,
                                         'url' => 'https://github.com/cakephp/debug_kit/tarball/master',
                                         'archive' => RECIPE_ARCHIVE_TARBALL,
                                         'tarballName' => 'cakephp-debug_kit-*',
                                         ),
                     'datasources' => array('name' => 'Datasources',
                                            'description' => 'CakePHP datasources plugin - 2.0 dev branch',
                                            'author' => 'CakePHP',
                                            'type' => RECIPE_TYPE_PLUGIN,
                                            'url' => 'https://github.com/cakephp/datasources/tarball/2.0',
                                            'archive' => RECIPE_ARCHIVE_TARBALL,
                                            'tarballName' => 'cakephp-datasources-*',
                                            ),
                     'search' => array('name' => 'Search',
                                       'description' => 'Search Plugin for CakePHP',
                                       'author' => 'Cake Development Corporation',
                                       'type' => RECIPE_TYPE_PLUGIN,
                                       'url' => 'https://github.com/CakeDC/search/tarball/master',
                                       'archive' => RECIPE_ARCHIVE_TARBALL,
                                       'tarballName' => 'CakeDC-search-*',
                                       ),
                     'utils' => array('name' => 'Utils',
                                      'description' => 'Utils Plugin for CakePHP',
                                      'author' => 'Cake Development Corporation',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/CakeDC/utils/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'CakeDC-utils-*',
                                      ),
                     'migrations' => array('name' => 'Migrations',
                                           'description' => 'Migrations Plugin for CakePHP',
                                           'author' => 'Cake Development Corporation',
                                           'type' => RECIPE_TYPE_PLUGIN,
                                           'url' => 'https://github.com/CakeDC/migrations/tarball/2.0',
                                           'archive' => RECIPE_ARCHIVE_TARBALL,
                                           'tarballName' => 'CakeDC-migrations-*',
                                           ),
                     'cakeplus' => array('name' => 'Cakeplus',
                                         'description' => 'Cake plus is cakephp plugin and provides some functions for CakePHP',
                                         'author' => 'ichikaway',
                                         'type' => RECIPE_TYPE_PLUGIN,
                                         'url' => 'https://github.com/ichikaway/cakeplus/tarball/2.0',
                                         'archive' => RECIPE_ARCHIVE_TARBALL,
                                         'tarballName' => 'ichikaway-cakeplus-*',
                                         ),
                     'xform' => array('name' => 'Xform',
                                      'description' => 'XFormHelper(Plugin) extends cakephp Form helper',
                                      'author' => 'ichikaway',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/ichikaway/xformHelper/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'ichikaway-xformHelper-*',
                                      ),
                     'autoappbuild' => array('name' => 'AutoAppBuild',
                                             'description' => 'AutoAppBuild for CakePHP 2.x',
                                             'author' => 'ichikaway',
                                             'type' => RECIPE_TYPE_PLUGIN,
                                             'url' => 'https://github.com/ichikaway/AutoAppBuild/tarball/master',
                                             'archive' => RECIPE_ARCHIVE_TARBALL,
                                             'tarballName' => 'ichikaway-AutoAppBuild-*',
                                             ),
                     'twitterbootstrap' => array('name' => 'TwitterBootstrap',
                                                 'description' => 'Cake plus is cakephp plugin and provides some functions for CakePHP',
                                                 'author' => 'slywalker',
                                                 'type' => RECIPE_TYPE_PLUGIN,
                                                 'url' => 'https://github.com/slywalker/TwitterBootstrap/tarball/master',
                                                 'pluginName' => 'TwitterBootstrap',
                                                 'archive' => RECIPE_ARCHIVE_TARBALL,
                                                 'tarballName' => 'slywalker-TwitterBootstrap-*',
                                                 ),
                     'filebinder' => array('name' => 'Filebinder',
                                           'description' => 'Filebinder: Simple file attachment plugin for CakePHP',
                                           'author' => 'Fusic Co.,Ltd.',
                                           'type' => RECIPE_TYPE_PLUGIN,
                                           'url' => 'https://github.com/fusic/filebinder/tarball/2.0',
                                           'archive' => RECIPE_ARCHIVE_TARBALL,
                                           'tarballName' => 'fusic-filebinder-*',
                                           ),
                     'zipcode' => array('name' => 'Zipcode',
                                        'description' => 'Zipcode Plugin for CakePHP',
                                        'author' => 'Fusic Co.,Ltd.',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/fusic/zipcode/tarball/2.0',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'fusic-zipcode-*',
                                        ),
                     'yak' => array('name' => 'Yak',
                                    'description' => 'Yak: Yet Another Ktai plugin for CakePHP',
                                    'author' => 'k1LoW',
                                    'type' => RECIPE_TYPE_PLUGIN,
                                    'url' => 'https://github.com/k1LoW/yak/tarball/2.0',
                                    'archive' => RECIPE_ARCHIVE_TARBALL,
                                    'tarballName' => 'k1LoW-yak-*',
                                    ),
                     'pearlocal' => array('name' => 'PearLocal',
                                          'description' => 'PEAR Local install plugin for CakePHP',
                                          'author' => 'k1LoW',
                                          'type' => RECIPE_TYPE_PLUGIN,
                                          'url' => 'https://github.com/k1LoW/pear_local/tarball/2.0',
                                          'archive' => RECIPE_ARCHIVE_TARBALL,
                                          'tarballName' => 'k1LoW-pear_local-*',
                                          ),
                     'po' => array('name' => 'Po',
                                   'description' => 'CakePHP .po File Edit Plugin',
                                   'author' => 'k1LoW',
                                   'type' => RECIPE_TYPE_PLUGIN,
                                   'url' => 'https://github.com/k1LoW/po/tarball/2.0',
                                   'archive' => RECIPE_ARCHIVE_TARBALL,
                                   'tarballName' => 'k1LoW-po-*',
                                   ),
                     'hasno' => array('name' => 'HasNo',
                                      'description' => 'Simple binding model practice plugin for CakePHP',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/has_no/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-has_no-*',
                                      ),
                     'escape' => array('name' => 'Escape',
                                       'description' => 'Auto escaping plugin for CakePHP',
                                       'author' => 'k1LoW',
                                       'type' => RECIPE_TYPE_PLUGIN,
                                       'url' => 'https://github.com/k1LoW/escape/tarball/2.0',
                                       'archive' => RECIPE_ARCHIVE_TARBALL,
                                       'tarballName' => 'k1LoW-escape-*',
                                       ),
                     'yalog' => array('name' => 'Yalog',
                                      'description' => 'Yalog: Yet Another Logger for CakePHP',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/yalog/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-yalog-*',
                                      ),
                     'yacsv' => array('name' => 'Yacsv',
                                      'description' => 'Yet another CSV utility plugin for CakePHP',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/Yacsv/tarball/master',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-Yacsv-*',
                                      ),
                     'collectionable' => array('name' => 'Collectionable',
                                               'description' => 'Collectionable Plugin',
                                               'author' => 'hiromi2424',
                                               'type' => RECIPE_TYPE_PLUGIN,
                                               'url' => 'https://github.com/hiromi2424/Collectionable/tarball/cake2',
                                               'archive' => RECIPE_ARCHIVE_TARBALL,
                                               'tarballName' => 'hiromi2424-Collectionable-*',
                                               ),
                     'transition' =>  array('name' => 'TransitionComponent',
                                            'description' => 'Transition Component',
                                            'author' => 'hiromi2424',
                                            'type' => RECIPE_TYPE_COMPONENT,
                                            'url' => 'https://raw.github.com/hiromi2424/TransitionComponent/cake2/Controller/Component/TransitionComponent.php',
                                            'archive' => RECIPE_ARCHIVE_FILE,
                                            ),
                     'ninja' => array('name' => 'Ninja',
                                      'description' => 'Ninja',
                                      'author' => 'hiromi2424',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/hiromi2424/ninja/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'hiromi2424-ninja-*',
                                      ),
                     'partial' => array('name' => 'Partial',
                                        'description' => 'PartialView',
                                        'author' => 'kozo',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/kozo/Partial/tarball/2.0-PartialView',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'kozo-Partial-*',
                                        ),
                     'debuglib' => array('name' => 'debuglib.php',
                                         'description' => 'debuglib: See what\'s going on inside your PHP variables!',
                                         'author' => 'Schüßler',
                                         'type' => RECIPE_TYPE_PLAIN,
                                         'url' => 'http://phpdebuglib.de/debuglib.php',
                                         'archive' => RECIPE_ARCHIVE_FILE,
                                         'installDir' => APP . 'Vendor/',
                                         ),
                     'cakektailibrary' => array('name' => 'CakeKtaiLibrary',
                                                'description' => 'Japanese mobile phone plugin for CakePHP',
                                                'author' => 'ECWorks',
                                                'type' => RECIPE_TYPE_PLUGIN,
                                                'url' => 'https://github.com/MASA-P/cake_ktai_library/tarball/0.x-2.x',
                                                'archive' => RECIPE_ARCHIVE_TARBALL,
                                                'tarballName' => 'MASA-P-cake_ktai_library-*',
                                                ),
                     'back' => array('name' => 'Back',
                                     'description' => 'Session base "history" back plugin for CakePHP',
                                     'author' => 'k1LoW',
                                     'type' => RECIPE_TYPE_PLUGIN,
                                     'url' => 'https://github.com/k1LoW/Back/tarball/master',
                                     'archive' => RECIPE_ARCHIVE_TARBALL,
                                     'tarballName' => 'k1LoW-Back-*',
                                     ),
                     'debugkitshortcut' => array('name' => 'DebugKitShortcut',
                                                 'description' => 'DebugKit Shortcut Panel',
                                                 'author' => 'k1LoW',
                                                 'type' => RECIPE_TYPE_PLUGIN,
                                                 'url' => 'https://github.com/k1LoW/DebugKitShortcut/tarball/master',
                                                 'archive' => RECIPE_ARCHIVE_TARBALL,
                                                 'tarballName' => 'k1LoW-DebugKitShortcut-*',
                                                 'require' => array('DebugKit'),
                                                 ),
                     'mongodb' => array('name' => 'Mongodb',
                                        'description' => 'mongoDB datasource for CakePHP',
                                        'author' => 'ichikaway',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/ichikaway/cakephp-mongodb/tarball/cake2.0',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'ichikaway-cakephp-mongodb-*',
                                        ),
                     'multivalidatable' =>  array('name' => 'MultivalidatableBehavior',
                                                  'description' => 'MultivalidatableBehavior for CakePHP2.x',
                                                  'author' => 'Sordi',
                                                  'type' => RECIPE_TYPE_BEHAVIOR,
                                                  'url' => 'https://raw.github.com/gist/2565103/629dd6307321b08be5c62fe9e5094591070b48e0/MultivalidatableBehabior.php',
                                                  'archive' => RECIPE_ARCHIVE_FILE,
                                                  ),
                     'exception' => array('name' => 'Exception',
                                          'description' => 'Exception template for CakePHP',
                                          'author' => 'k1LoW',
                                          'type' => RECIPE_TYPE_PLUGIN,
                                          'url' => 'https://github.com/k1LoW/Exception/tarball/master',
                                          'archive' => RECIPE_ARCHIVE_TARBALL,
                                          'tarballName' => 'k1LoW-Exception-*',
                                          ),
                     'fuzzy' => array('name' => 'Fuzzy',
                                      'description' => 'Fuzzy plugin for CakePHP',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/Fuzzy/tarball/master',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-Fuzzy-*',
                                      ),
                     'fatty' => array('name' => 'Fatty',
                                      'description' => 'Fatty: Simple Git repogitory browser plugin for CakePHP.',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/fatty/tarball/2.0',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-fatty-*',
                                      ),
                     'query' => array('name' => 'Query',
                                      'description' => 'Query: Simple SQL client for CakePHP.',
                                      'author' => 'k1LoW',
                                      'type' => RECIPE_TYPE_PLUGIN,
                                      'url' => 'https://github.com/k1LoW/Query/tarball/master',
                                      'archive' => RECIPE_ARCHIVE_TARBALL,
                                      'tarballName' => 'k1LoW-Query-*',
                                      ),
                     'secured' => array('name' => 'Secured',
                                        'description' => 'SSL Component',
                                        'author' => 'hiromi2424',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/hiromi2424/secured/tarball/2.0',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'hiromi2424-secured-*',
                                        ),
                     'yasd' => array('name' => 'Yasd',
                                     'description' => 'Yer Another SoftDeletable Behavior for CakePHP',
                                     'author' => 'k1LoW',
                                     'type' => RECIPE_TYPE_PLUGIN,
                                     'url' => 'https://github.com/k1LoW/Yasd/tarball/master',
                                     'archive' => RECIPE_ARCHIVE_TARBALL,
                                     'tarballName' => 'k1LoW-Yasd-*',
                                     ),
                     'routine' => array('name' => 'Routine',
                                        'description' => 'Routine',
                                        'author' => 'k1LoW',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/k1LoW/Routine/tarball/master',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'k1LoW-Routine-*',
                                        ),
                     'setting' => array('name' => 'Setting',
                                        'description' => 'Setting: Database driven setting plugin for CakePHP.',
                                        'author' => 'k1LoW',
                                        'type' => RECIPE_TYPE_PLUGIN,
                                        'url' => 'https://github.com/k1LoW/Setting/tarball/master',
                                        'archive' => RECIPE_ARCHIVE_TARBALL,
                                        'tarballName' => 'k1LoW-Setting-*',
                                        ),
                     'xls' => array('name' => 'Xls',
                                    'description' => 'Xls',
                                    'author' => 'k1LoW',
                                    'type' => RECIPE_TYPE_PLUGIN,
                                    'url' => 'https://github.com/k1LoW/Xls/tarball/master',
                                    'archive' => RECIPE_ARCHIVE_TARBALL,
                                    'tarballName' => 'k1LoW-Xls-*',
                                    'require' => array('PHPExcel'),
                                    ),
                     'phpexcel' => array('name' => 'PHPExcel',
                                         'description' => 'PHPExcel',
                                         'author' => 'PHPOffice',
                                         'type' => RECIPE_TYPE_PLAIN,
                                         'url' => 'https://github.com/PHPOffice/PHPExcel/tarball/develop',
                                         'archive' => RECIPE_ARCHIVE_TARBALL,
                                         'tarballName' => 'PHPOffice-PHPExcel-*',
                                         'installDir' => APP . 'Vendor/',
                                         ),
                     'controllerprefix' => array('name' => 'ControllerPrefix',
                                                 'description' => 'Controller prefix plugin for CakePHP',
                                                 'author' => 'k1LoW',
                                                 'type' => RECIPE_TYPE_PLUGIN,
                                                 'url' => 'https://github.com/k1LoW/controller_prefix/tarball/2.0',
                                                 'archive' => RECIPE_ARCHIVE_TARBALL,
                                                 'tarballName' => 'k1LoW-controller_prefix-*',
                                                 ),
                     'pdf' => array('name' => 'Pdf',
                                    'description' => 'Pdf: TCPDF simple wrapper for CakePHP',
                                    'author' => 'k1LoW',
                                    'type' => RECIPE_TYPE_PLUGIN,
                                    'url' => 'https://github.com/k1LoW/Pdf/tarball/master',
                                    'archive' => RECIPE_ARCHIVE_TARBALL,
                                    'tarballName' => 'k1LoW-Pdf-*',
                                    'require' => array('TCPDF', 'FPDI'),
                                    ),
                     'tcpdf' => array('name' => 'TCPDF',
                                      'description' => 'PHP class for PDF',
                                      'author' => 'Nicola Asuni',
                                      'type' => RECIPE_TYPE_PLAIN,
                                      'url' => 'http://downloads.sourceforge.net/project/tcpdf/tcpdf_5_9_179.zip',
                                      'archive' => RECIPE_ARCHIVE_ZIP,
                                      'installDir' => APP . 'Vendor/',
                                      ),
                     'fpdi' => array('name' => 'FPDI',
                                     'description' => 'FPDI',
                                     'author' => 'Setasign - Jan Slabon',
                                     'type' => RECIPE_TYPE_PLAIN,
                                     'url' => 'http://www.setasign.de/supra/kon2_dl/39034/FPDI-1.4.2.zip',
                                     'archive' => RECIPE_ARCHIVE_ZIP,
                                     'installDir' => APP . 'Vendor/',
                                     'require' => array('fpdftpl'),
                                     ),
                     'fpdftpl' => array('name' => 'FPDF_TPL',
                                        'description' => 'FPDF_TPL',
                                        'author' => 'Setasign - Jan Slabon',
                                        'type' => RECIPE_TYPE_PLAIN,
                                        'url' => 'http://www.setasign.de/supra/kon2_dl/30471/FPDF_TPL-1.2.zip',
                                        'archive' => RECIPE_ARCHIVE_ZIP,
                                        'installDir' => APP . 'Vendor/FPDI/',
                                        ),
                     );