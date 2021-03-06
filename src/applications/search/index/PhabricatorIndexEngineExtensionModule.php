<?php

final class PhabricatorIndexEngineExtensionModule
  extends PhabricatorConfigModule {

  public function getModuleKey() {
    return 'indexengine';
  }

  public function getModuleName() {
    return pht('Engine: Index');
  }

  public function renderModuleStatus(AphrontRequest $request) {
    $viewer = $request->getViewer();

    $extensions = PhabricatorIndexEngineExtension::getAllExtensions();

    $rows = array();
    foreach ($extensions as $extension) {
      $rows[] = array(
        get_class($extension),
        $extension->getExtensionName(),
      );
    }

    $table = id(new AphrontTableView($rows))
      ->setHeaders(
        array(
          pht('Class'),
          pht('Name'),
        ))
      ->setColumnClasses(
        array(
          null,
          'wide pri',
        ));

    return id(new PHUIObjectBoxView())
      ->setHeaderText(pht('IndexEngine Extensions'))
      ->setBackground(PHUIObjectBoxView::BLUE_PROPERTY)
      ->setTable($table);
  }

}
