<?php

/**
 * Nette Framework
 *
 * Copyright (c) 2004, 2009 David Grudl (http://davidgrudl.com)
 *
 * This source file is subject to the "Nette license" that is bundled
 * with this package in the file license.txt.
 *
 * For more information please see http://nettephp.com
 *
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @license    http://nettephp.com/license  Nette license
 * @link       http://nettephp.com
 * @category   Nette
 * @package    Nette\Loaders
 */



require_once dirname(__FILE__) . '/../Loaders/AutoLoader.php';



/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @package    Nette\Loaders
 */
class NetteLoader extends AutoLoader
{
	/** @var NetteLoader */
	public static $instance;

	/** @var string  base file path */
	public $base;

	/** @var array */
	public $list = array(
		'abortexception' => '/Application/Exceptions/AbortException.php',
		'ambiguousserviceexception' => '/ServiceLocator.php',
		'annotations' => '/Annotations.php',
		'appform' => '/Application/AppForm.php',
		'application' => '/Application/Application.php',
		'applicationexception' => '/Application/Exceptions/ApplicationException.php',
		'argumentoutofrangeexception' => '/exceptions.php',
		'arraylist' => '/Collections/ArrayList.php',
		'arraytools' => '/ArrayTools.php',
		'authenticationexception' => '/Security/AuthenticationException.php',
		'autoloader' => '/Loaders/AutoLoader.php',
		'badrequestexception' => '/Application/Exceptions/BadRequestException.php',
		'badsignalexception' => '/Application/Exceptions/BadSignalException.php',
		'basetemplate' => '/Templates/BaseTemplate.php',
		'button' => '/Forms/Controls/Button.php',
		'cache' => '/Caching/Cache.php',
		'cachinghelper' => '/Templates/Filters/CachingHelper.php',
		'checkbox' => '/Forms/Controls/Checkbox.php',
		'clirouter' => '/Application/Routers/CliRouter.php',
		'collection' => '/Collections/Collection.php',
		'component' => '/Component.php',
		'componentcontainer' => '/ComponentContainer.php',
		'config' => '/Config/Config.php',
		'configadapterini' => '/Config/ConfigAdapterIni.php',
		'configadapterxml' => '/Config/ConfigAdapterXml.php',
		'configurator' => '/Configurator.php',
		'control' => '/Application/Control.php',
		'conventionalrenderer' => '/Forms/Renderers/ConventionalRenderer.php',
		'curlybracketsfilter' => '/Templates/Filters/LatteFilter.php',
		'curlybracketsmacros' => '/Templates/Filters/LatteFilter.php',
		'debug' => '/Debug.php',
		'deprecatedexception' => '/exceptions.php',
		'directorynotfoundexception' => '/exceptions.php',
		'downloadresponse' => '/Application/Responses/DownloadResponse.php',
		'dummystorage' => '/Caching/DummyStorage.php',
		'environment' => '/Environment.php',
		'fatalerrorexception' => '/exceptions.php',
		'filenotfoundexception' => '/exceptions.php',
		'filestorage' => '/Caching/FileStorage.php',
		'fileupload' => '/Forms/Controls/FileUpload.php',
		'form' => '/Forms/Form.php',
		'formcontainer' => '/Forms/FormContainer.php',
		'formcontrol' => '/Forms/Controls/FormControl.php',
		'formgroup' => '/Forms/FormGroup.php',
		'forwardingresponse' => '/Application/Responses/ForwardingResponse.php',
		'framework' => '/Framework.php',
		'freezableobject' => '/FreezableObject.php',
		'ftp' => '/Web/Ftp.php',
		'ftpexception' => '/Web/Ftp.php',
		'hashtable' => '/Collections/Hashtable.php',
		'hiddenfield' => '/Forms/Controls/HiddenField.php',
		'html' => '/Web/Html.php',
		'httprequest' => '/Web/HttpRequest.php',
		'httpresponse' => '/Web/HttpResponse.php',
		'httpuploadedfile' => '/Web/HttpUploadedFile.php',
		'iauthenticator' => '/Security/IAuthenticator.php',
		'iauthorizator' => '/Security/IAuthorizator.php',
		'icachestorage' => '/Caching/ICacheStorage.php',
		'icollection' => '/Collections/ICollection.php',
		'icomponent' => '/IComponent.php',
		'icomponentcontainer' => '/IComponentContainer.php',
		'iconfigadapter' => '/Config/IConfigAdapter.php',
		'idebuggable' => '/IDebuggable.php',
		'identity' => '/Security/Identity.php',
		'ifiletemplate' => '/Templates/IFileTemplate.php',
		'iformcontrol' => '/Forms/IFormControl.php',
		'iformrenderer' => '/Forms/IFormRenderer.php',
		'ihttprequest' => '/Web/IHttpRequest.php',
		'ihttpresponse' => '/Web/IHttpResponse.php',
		'iidentity' => '/Security/IIdentity.php',
		'ilist' => '/Collections/IList.php',
		'image' => '/Image.php',
		'imagebutton' => '/Forms/Controls/ImageButton.php',
		'imagemagick' => '/ImageMagick.php',
		'imailer' => '/Mail/IMailer.php',
		'imap' => '/Collections/IMap.php',
		'inamingcontainer' => '/Forms/INamingContainer.php',
		'instancefilteriterator' => '/InstanceFilterIterator.php',
		'instantclientscript' => '/Forms/Renderers/InstantClientScript.php',
		'invalidlinkexception' => '/Application/Exceptions/InvalidLinkException.php',
		'invalidpresenterexception' => '/Application/Exceptions/InvalidPresenterException.php',
		'invalidstateexception' => '/exceptions.php',
		'ioexception' => '/exceptions.php',
		'ipartiallyrenderable' => '/Application/IRenderable.php',
		'ipermissionassertion' => '/Security/IPermissionAssertion.php',
		'ipresenter' => '/Application/IPresenter.php',
		'ipresenterloader' => '/Application/IPresenterLoader.php',
		'ipresenterresponse' => '/Application/IPresenterResponse.php',
		'irenderable' => '/Application/IRenderable.php',
		'iresource' => '/Security/IResource.php',
		'irole' => '/Security/IRole.php',
		'irouter' => '/Application/IRouter.php',
		'iservicelocator' => '/IServiceLocator.php',
		'iset' => '/Collections/ISet.php',
		'isignalreceiver' => '/Application/ISignalReceiver.php',
		'istatepersistent' => '/Application/IStatePersistent.php',
		'isubmittercontrol' => '/Forms/ISubmitterControl.php',
		'itemplate' => '/Templates/ITemplate.php',
		'itranslator' => '/ITranslator.php',
		'iuser' => '/Web/IUser.php',
		'jsonresponse' => '/Application/Responses/JsonResponse.php',
		'keynotfoundexception' => '/Collections/Hashtable.php',
		'lattefilter' => '/Templates/Filters/LatteFilter.php',
		'lattemacros' => '/Templates/Filters/LatteMacros.php',
		'limitedscope' => '/Loaders/LimitedScope.php',
		'link' => '/Application/Link.php',
		'mail' => '/Mail/Mail.php',
		'mailmimepart' => '/Mail/MailMimePart.php',
		'memberaccessexception' => '/exceptions.php',
		'memcachedstorage' => '/Caching/MemcachedStorage.php',
		'multirouter' => '/Application/Routers/MultiRouter.php',
		'multiselectbox' => '/Forms/Controls/MultiSelectBox.php',
		'netteloader' => '/Loaders/NetteLoader.php',
		'notimplementedexception' => '/exceptions.php',
		'notsupportedexception' => '/exceptions.php',
		'object' => '/Object.php',
		'objectmixin' => '/ObjectMixin.php',
		'paginator' => '/Paginator.php',
		'permission' => '/Security/Permission.php',
		'presenter' => '/Application/Presenter.php',
		'presentercomponent' => '/Application/PresenterComponent.php',
		'presenterhelpers' => '/Application/PresenterHelpers.php',
		'presenterloader' => '/Application/PresenterLoader.php',
		'presenterrequest' => '/Application/PresenterRequest.php',
		'radiolist' => '/Forms/Controls/RadioList.php',
		'recursivecomponentiterator' => '/ComponentContainer.php',
		'recursivehtmliterator' => '/Web/Html.php',
		'redirectingresponse' => '/Application/Responses/RedirectingResponse.php',
		'renderresponse' => '/Application/Responses/RenderResponse.php',
		'repeatercontrol' => '/Forms/Controls/RepeaterControl.php',
		'robotloader' => '/Loaders/RobotLoader.php',
		'route' => '/Application/Routers/Route.php',
		'rule' => '/Forms/Rule.php',
		'rules' => '/Forms/Rules.php',
		'safestream' => '/IO/SafeStream.php',
		'selectbox' => '/Forms/Controls/SelectBox.php',
		'sendmailmailer' => '/Mail/SendmailMailer.php',
		'servicelocator' => '/ServiceLocator.php',
		'session' => '/Web/Session.php',
		'sessionnamespace' => '/Web/SessionNamespace.php',
		'set' => '/Collections/Set.php',
		'simpleauthenticator' => '/Security/SimpleAuthenticator.php',
		'simpleloader' => '/Loaders/SimpleLoader.php',
		'simplerouter' => '/Application/Routers/SimpleRouter.php',
		'smartcachingiterator' => '/SmartCachingIterator.php',
		'snippethelper' => '/Templates/Filters/SnippetHelper.php',
		'string' => '/String.php',
		'submitbutton' => '/Forms/Controls/SubmitButton.php',
		'template' => '/Templates/Template.php',
		'templatecachestorage' => '/Templates/TemplateCacheStorage.php',
		'templatefilters' => '/Templates/Filters/TemplateFilters.php',
		'templatehelpers' => '/Templates/Filters/TemplateHelpers.php',
		'textarea' => '/Forms/Controls/TextArea.php',
		'textbase' => '/Forms/Controls/TextBase.php',
		'textinput' => '/Forms/Controls/TextInput.php',
		'tools' => '/Tools.php',
		'uri' => '/Web/Uri.php',
		'uriscript' => '/Web/UriScript.php',
		'user' => '/Web/User.php',
		'userclientscript' => '/Forms/Renderers/UserClientScript.php',
	);



	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return NetteLoader
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL) {
			self::$instance = new self;
		}
		return self::$instance;
	}



	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = strtolower($type);
		if (isset($this->list[$type])) {
			LimitedScope::load($this->base . $this->list[$type]);
			self::$count++;
		}
	}

}
