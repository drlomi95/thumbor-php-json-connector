# thumbor-php-json-connector
Go to https://github.com/99designs/phumbor and install the library with it's dependencies with composer.
Connect all dependencies to the thumbor-php-json-connector php file,properly point to your Json configuration file in the php file, in your wordpress or web server rember to use the php file and you're ready to get all of thumbor's functionality in just one function with two arguments.
Ex: src='<#?php thumb_url("my_conf","http://image-url.jpg") ?>' alt=""/>
The above tag will display the image http://image-url.jpg in your website customized by the various Thumbor filters and options you placed in the json file. 
