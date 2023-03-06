<?php

class ConferenceFaultsController extends Portabilis_Controller_ReportCoreController
{
    /**
     * @var int
     */
    protected $_processoAp = 230210;

    /**
     * @var string
     */
    protected $_titulo = 'Relatório de Conferência de Faltas';

    /**
     * @inheritdoc
     */
    protected function _preRender()
    {
        parent::_preRender();

        Portabilis_View_Helper_Application::loadStylesheet($this, 'intranet/styles/localizacaoSistema.css');

        $this->breadcrumb('Emissão do relatório de conferência de faltas', [
            'educar_index.php' => 'Escola',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function form()
    {
        $this->inputsHelper()->dynamic(['ano', 'instituicao', 'escola', 'curso', 'serie', 'turma']); 
        $this->inputsHelper()->dynamic('componenteCurricular', ['required' => false]);
        $this->inputsHelper()->checkbox('emitir_legenda', ['value' => true,'label' => 'Emitir legenda?', 'required' => false]);
        $this->inputsHelper()->date('data_inicial', ['required' => true, 'label' => 'Data inicial']);
        $this->inputsHelper()->date('data_final', ['required' => true, 'label' => 'Data final']);                   
    }

    /**
     * @inheritdoc
     */
    public function beforeValidation()
    {
        $this->report->addArg('ano', (int)$this->getRequest()->ano);
        $this->report->addArg('instituicao', (int)$this->getRequest()->ref_cod_instituicao);
        $this->report->addArg('escola', (int)$this->getRequest()->ref_cod_escola);
        $this->report->addArg('curso', (int)$this->getRequest()->ref_cod_curso);
        $this->report->addArg('serie', (int)$this->getRequest()->ref_cod_serie);
        $this->report->addArg('turma', (int)$this->getRequest()->ref_cod_turma);
        $this->report->addArg('disciplina', (int) $this->getRequest()->ref_cod_componente_curricular);
        $this->report->addArg('data_inicial', Portabilis_Date_Utils::brToPgSQL($this->getRequest()->data_inicial));
        $this->report->addArg('data_final', Portabilis_Date_Utils::brToPgSQL($this->getRequest()->data_final));
        $this->report->addArg('emitir_legenda', (bool)$this->getRequest()->emitir_legenda);               
    }

    /**
     * @return ConferenceFaultsReport
     *
     * @throws Exception
     */
    public function report()
    {
        return new ConferenceFaultsReport();
    }
}
