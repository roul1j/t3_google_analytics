<?php
namespace JR\T3GoogleAnalytics\Modules;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Module\AbstractModule;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class OneController
 *
 * @package Mattes\DummyModule\Modules
 */
class GoogleAnalyticsController extends AbstractModule
{


    /**
     * Injects the request object for the current request or subrequest
     *
     * @param ServerRequestInterface $request The current request
     * @param ResponseInterface $response The Response
     *
     * @return ResponseInterface The response with the content
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        DebuggerUtility::var_dump($request);
        DebuggerUtility::var_dump($response);

//		$this->moduleTemplate->setModuleId('web_info');
        $this->setUpModule();

        $content = BackendUtility::cshItem('xMOD_csh_corebe', 'TCEforms');


        $content .= nl2br('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
         Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam
          felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,
           fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
            justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper
             nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim
             . Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.');
        $this->moduleTemplate->setContent($content);
        $response->getBody()->write($this->moduleTemplate->renderContent());

        return $response;
    }

    /**
     * Injects the request object for the current request or subrequest
     *
     * @param ServerRequestInterface $request The current request
     * @param ResponseInterface $response The Response
     *
     * @return ResponseInterface The response with the content
     */
    public function secondAction(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->setUpModule();
        $this->moduleTemplate->setContent('<br><br>I am the Result of the SecondAction');
        $response->getBody()->write($this->moduleTemplate->renderContent());

        return $response;
    }

    /**
     * Sets up the module with navigation and such
     *
     * @return void
     */
    protected function setUpModule()
    {
        $this->makeButtons();
        $this->makeControllerMenu();
        $this->makeActionMenu();
        $this->makeParameterMenu();
    }

    /**
     * Sets up the module with buttons
     *
     * @return void
     */
    protected function makeButtons()
    {
        $buttonBar =
            $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();

        /*$csh = $buttonBar->makeFullyRenderedButton()->setHtmlSource(
            BackendUtility::cshItem('xMOD_csh_corebe', 'TCEforms')
        );
        $buttonBar->addButton($csh);*/

        $saveButton = $buttonBar->makeInputButton()
            ->setName('save')
            ->setValue('1')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon('actions-document-save', Icon::SIZE_SMALL))
            ->setTitle('Save');

        $saveAndCloseButton = $buttonBar->makeInputButton()
            ->setName('save_and_close')
            ->setValue('1')
            ->setTitle('Save and close')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon(
                'actions-document-save-close',
                Icon::SIZE_SMALL
            ));

        $saveAndShowPageButton = $buttonBar->makeInputButton()
            ->setName('save_and_show')
            ->setValue('1')
            ->setTitle('Save and show')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon('actions-document-save-view', Icon::SIZE_SMALL));

        $deleteButton = $buttonBar->makeLinkButton()
            ->setHref('#')
            ->setTitle('Delete item')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon('actions-edit-delete', Icon::SIZE_SMALL));

        $moveButton = $buttonBar->makeLinkButton()
            ->setHref('#')
            ->setTitle('Move element')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon('actions-page-move', Icon::SIZE_SMALL));

        $editPageButton = $buttonBar->makeLinkButton()
            ->setHref('#')
            ->setTitle('Edit properties')
            ->setIcon($this->moduleTemplate->getIconFactory()->getIcon('actions-page-open', Icon::SIZE_SMALL));

        $splitButtonElement = $buttonBar->makeSplitButton()
            ->addItem($saveButton)
            ->addItem($saveAndCloseButton)
            ->addItem($saveAndShowPageButton);

        $buttonBar->addButton($editPageButton, ButtonBar::BUTTON_POSITION_LEFT, 1)
            ->addButton($moveButton, ButtonBar::BUTTON_POSITION_LEFT, 1)
            ->addButton($splitButtonElement, ButtonBar::BUTTON_POSITION_LEFT, 2)
            ->addButton($deleteButton, ButtonBar::BUTTON_POSITION_LEFT, 3)
            ->addButton($editPageButton, ButtonBar::BUTTON_POSITION_RIGHT, 1)
            ->addButton($moveButton, ButtonBar::BUTTON_POSITION_RIGHT, 1)
            ->addButton($deleteButton, ButtonBar::BUTTON_POSITION_RIGHT, 2)
            ->addButton($splitButtonElement, ButtonBar::BUTTON_POSITION_RIGHT, 3);

        $shortcut = $buttonBar->makeShortcutButton()->setModuleName('web_info');
        $buttonBar->addButton($shortcut);

        $cshBtn = $buttonBar->makeHelpButton()->setModuleName('xMOD_csh_corebe')->setFieldName('TCEforms');
        $buttonBar->addButton($cshBtn);

        $cshBtnBroken = $buttonBar->makeHelpButton()->setModuleName('xMOD_csh_corebe')->setFieldName('TCEformsXXX');
        $buttonBar->addButton($cshBtnBroken);

    }

    /**
     * Creates a menu of TabsMenu
     *
     * @return void
     *
     * @throws \InvalidArgumentException In case of invalid menuItems
     */
    protected function makeControllerMenu()
    {
        $menuRegistry =
            $this->moduleTemplate->getDocHeaderComponent()->getMenuRegistry();
        $menu = $menuRegistry->makeMenu()->setIdentifier('ControllerMenu')
            ->setLabel('MenuLabel 1');

        $item1 = $menu
            ->makeMenuItem()
            ->setHref('#')
            ->setTitle('Params');
        $menu->addMenuItem($item1);

        $item2 = $menu
            ->makeMenuItem()
            ->setHref('#')
            ->setTitle('Ctrl + Act + Params')
            ->setActive(true);
        $menu->addMenuItem($item2);

        $item3 = $menu
            ->makeMenuItem()
            ->setHref('#')
            ->setTitle('Ctrl + Act');
        $menu->addMenuItem($item3);
        $menuRegistry->addMenu($menu);
    }

    /**
     * Creates a menu of PillsMenu
     *
     * @return void
     *
     * @throws \InvalidArgumentException In case of invalid menuItems
     */
    protected function makeActionMenu()
    {
        $menuRegistry =
            $this->moduleTemplate->getDocHeaderComponent()->getMenuRegistry();
        $menu = $menuRegistry->makeMenu()->setIdentifier('ActionMenu')
            ->setLabel('MenuLabel 2');
        $activeAction = GeneralUtility::_GP('action');

        $item1 = $menu
            ->makeMenuItem()
            ->setHref(BackendUtility::getModuleUrl('web_txdummy'))
            ->setTitle('Action Item 1')
            ->setActive(empty($activeAction));
        $menu->addMenuItem($item1);

        $item2 = $menu
            ->makeMenuItem()
            ->setHref(BackendUtility::getModuleUrl('web_txdummy', ['action' => 'secondAction']))
            ->setTitle('Action Item 2')
            ->setActive($activeAction === 'secondAction');
        $menu->addMenuItem($item2);
        $menuRegistry->addMenu($menu);
    }

    /**
     * Creates a menu of SelectBoxJumpMenu
     *
     * @return void
     *
     * @throws \InvalidArgumentException In case of invalid menuItems
     */
    protected function makeParameterMenu()
    {
        $menuRegistry =
            $this->moduleTemplate->getDocHeaderComponent()->getMenuRegistry();
        $menu = $menuRegistry->makeMenu()->setIdentifier('parameterMenu')
            ->setLabel('Select an option');

        $item1 = $menu
            ->makeMenuItem()
            ->setHref('#')
            ->setTitle('Parameter Item 1');
        $menu->addMenuItem($item1);

        $item2 = $menu
            ->makeMenuItem()
            ->setHref('#')
            ->setTitle('Parameter Item 2')
            ->setActive(true);
        $menu->addMenuItem($item2);
        $menuRegistry->addMenu($menu);
    }
}
