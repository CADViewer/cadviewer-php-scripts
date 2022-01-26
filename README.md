# cadviewer-php-scripts

PHP scripts for CADViewer control of back-end converters.


## This package contains

1: PHP scripts for CADViewer for communication between CADViewer and server side AutoXchange 2022 CAD converter, as well scrips for all other server operations; file-operations, etc. 
- in its preferred folder structure     /cadviewer/php/

## This package does not contains

2: CADViewer script library

3: Any back-end CAD Converters such as AutoXchange 2022


## How to Use

Install CADViewer and back-end CAD Converters, follow installation instructions from the documentation link below.

A: As a preferred alternative, install a full server of CADViewer including both script library and converters in a preferred folder-structure. https://github.com/CADViewer/cadviewer-script-library

B: Once 2: and 3: is installed, typically the HTML samples under /cadviewer/html/ can be run from a web-browser. Use http://localhost/cadviewer/html/CADViewer_fileloader_670.html as a starting point (assuming that your have installed under http://localhost).


C: If changing the location of the installation, please update ***/cadviewer/php/CADViewer_config.php***. The top part of this config file contains automated settings of ***$home_dir*** (cadviewer install folder) and ***$httpHost*** (cadviewer install folder url), but they can be manually overwritten. It also contains settings for the install platform (windows or linux). 

D: If updating any of executables in the install structure, then update their variable names in  ***/cadviewer/php/CADViewer_config.php**. These varaiables can be found with ***"_executable"*** in the variable name, for example ***"ax2020_executable"***. 

E: Please note the variable controls in the HTML documents as described below in ***Troubleshooting***.




## Documentation 

-   [CADViewer Techdocs and Installation Guide](https://cadviewer.com/cadviewertechdocs/download)



## How To Install CADViewer Handlers

Please refer to the general Documentation above, for the PHP back-end handlers, there is more information on:  

- [PHP](https://cadviewer.com/cadviewertechdocs/handlers/php/)



 
 ## Troubleshooting

One issue that often appears in installations is that interface icons do not display properly:

![Icons](https://cadviewer.com/cadviewertechdocs/images/missing_icons.png "Icons missing")

Typically the variables *ServerUrl*, *ServerLocation* or *ServerBackEndUrl* in the controlling **HTML**  document in ***/cadviewer/html/*** are not set to reflect the front-end server url or port.

<pre style="line-height: 110%">


    var ServerBackEndUrl = "";  // or what is appropriate for my server; used for NodeJS server only
    var ServerUrl = "http://localhost/cadviewer/";   // or what is appropriate for my server
    var ServerLocation = ""; // or what is appropriate for my server
</pre>

 
 
**Have Fun!**  - and get in [touch](mailto:developer@tailormade.com)  with us!

