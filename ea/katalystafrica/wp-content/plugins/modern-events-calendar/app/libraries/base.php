<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * Webnus MEC Base class.
 * @author Webnus <info@webnus.biz>
 * @abstract
 */
abstract class MEC_base extends MEC
{
    /**
     * Returns MEC_db instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_db instance
     */
	final public function getDB()
    {
        return MEC::getInstance('app.libraries.db');
    }
    
    /**
     * Returns MEC_request instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_request instance
     */
    final public function getRequest()
    {
        return MEC::getInstance('app.libraries.request');
    }
    
    /**
     * Returns MEC_file instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_file instance
     */
    final public function getFile()
    {
        return MEC::getInstance('app.libraries.filesystem', 'MEC_file');
    }
    
    /**
     * Returns MEC_folder instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_folder instance
     */
    final public function getFolder()
    {
        return MEC::getInstance('app.libraries.filesystem', 'MEC_folder');
    }
    
    /**
     * Returns MEC_path instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_path instance
     */
    final public function getPath()
    {
        return MEC::getInstance('app.libraries.filesystem', 'MEC_path');
    }
    
    /**
     * Returns MEC_main instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_main instance
     */
    final public function getMain()
    {
        return MEC::getInstance('app.libraries.main');
    }
    
    /**
     * Returns MEC_factory instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_factory instance
     */
    final public function getFactory()
    {
        return MEC::getInstance('app.libraries.factory');
    }
    
    /**
     * Returns MEC_render instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_render instance
     */
    final public function getRender()
    {
        return MEC::getInstance('app.libraries.render');
    }
    
    /**
     * Returns MEC_parser instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_parser instance
     */
    final public function getParser()
    {
        return MEC::getInstance('app.libraries.parser');
    }
    
    /**
     * Returns MEC_feed instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_feed instance
     */
    final public function getFeed()
    {
        return MEC::getInstance('app.libraries.feed');
    }
    
    /**
     * Returns MEC_book instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_book instance
     */
    final public function getBook()
    {
        return MEC::getInstance('app.libraries.book');
    }
    
    /**
     * Returns MEC_notifications instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_notifications instance
     */
    final public function getNotifications()
    {
        return MEC::getInstance('app.libraries.notifications');
    }

    /**
     * Returns MEC_envato instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \MEC_envato instance
     */
    final public function getEnvato()
    {
        return MEC::getInstance('app.libraries.envato');
    }

    /**
     * Returns QRCode instance
     * @final
     * @author Webnus <info@webnus.biz>
     * @return \QRcode instance
     */
    final public function getQRcode()
    {
        self::import('app.libraries.qrcode');
        return new QRcode();
    }
}