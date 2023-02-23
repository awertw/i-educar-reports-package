<?php

use iEducar\Reports\JsonDataSource;

class ConferenceFaultsReport extends Portabilis_Report_ReportCore
{
    use JsonDataSource;

    /**
     * @inheritdoc
     */
    public function templateName()
    {      
        return 'conference-faults';      
    }

    /**
     * @inheritdoc
     */
    public function requiredArgs()
    {
        $this->addRequiredArg('ano');
        $this->addRequiredArg('instituicao');
        $this->addRequiredArg('escola');
        $this->addRequiredArg('curso');
        $this->addRequiredArg('serie');
        $this->addRequiredArg('turma');
    }


    /**
     * @inheritdoc
     */
    public function useJson()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getJsonData()
    {
        $queryMainReport = $this->getSqlMainReport();
        $queryHeaderReport = $this->getSqlHeaderReport();

        return [
            'main' => Portabilis_Utils_Database::fetchPreparedQuery($queryMainReport),
            'header' => Portabilis_Utils_Database::fetchPreparedQuery($queryHeaderReport),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getJsonQuery()
    {
        return 'main';
    }

    /**
     * Retorna o SQL para buscar os dados do relatório principal.
     *
     * TODO #refatorar
     *
     * @return string
     */
    public function getSqlMainReport()
    {
        $instituicao = $this->args['instituicao'];
        $ano = $this->args['ano'];
        $escola = $this->args['escola'];
        $curso = $this->args['curso'];
        $serie = $this->args['serie'];
        $turma = $this->args['turma'];        
        $componente_curricular = $this->args['componente_curricular'] ?: 0;

        if (this->args['componente_curricular']) {
          $qtdFaltas = $objFrequencia->getTotalFaltas($matriculaId, $params['componente_curricular']);          
        }
        else {
          $qtdFaltas = $objFrequencia->getTotalFaltas($matriculaId, $params[null]);
        }

        $data_inicial = ' AND TRUE ';
        $data_final = ' AND TRUE ';
        

        if ($this->args['data_inicial']) {
            $data_inicial = " AND frequencia.data >= '{$this->args['data_inicial']}'";
        }

        if ($this->args['data_final']) {
            $data_final = " AND frequencia.data <= '{$this->args['data_final']}'";
        }

      return "
        SELECT DISTINCT matricula.cod_matricula AS cod_matricula,
        sequencial_fechamento,
           aluno.cod_aluno AS cod_aluno,
           relatorio.get_texto_sem_caracter_especial(pessoa.nome) AS nm_aluno,
           view_situacao.texto_situacao AS situacao,
           CASE
               WHEN matricula_turma.remanejado = true THEN null
               ELSE
                  trim(to_char(modules.frequencia_da_matricula(matricula.cod_matricula),'99999999999D99'))::character varying
           END AS frequencia_geral,

          (SELECT replace(textcat_all(abv), '<br>','|') FROM (SELECT abreviatura || ' - ' || nome AS abv
           FROM relatorio.view_componente_curricular
           WHERE view_componente_curricular.cod_turma = turma.cod_turma
           ORDER BY abreviatura, nome)  tabl) as legenda,

      CASE
          WHEN matricula_turma.remanejado = true THEN null
          ELSE
             (SELECT COALESCE(
                         (SELECT COUNT(*) + SUM(LENGTH(frequencia_aluno.aulas_faltou) - LENGTH(REPLACE(frequencia_aluno.aulas_faltou, ',', '')))
                         FROM modules.frequencia_aluno, modules.frequencia
                         WHERE frequencia_aluno.ref_frequencia = frequencia.id
                           AND frequencia.ref_componente_curricular = view_componente_curricular.id
                           AND frequencia_aluno.ref_cod_matricula = matricula.cod_matricula 					  
                           {$data_inicial}
                           {$data_final},
                         (SELECT SUM(quantidade)
                          FROM modules.falta_geral, modules.falta_aluno
                          WHERE falta_geral.falta_aluno_id = falta_aluno.id
                            AND falta_aluno.matricula_id = matricula.cod_matricula                        
                            AND falta_aluno.tipo_falta = 1)))::character varying
      END AS faltas,
    
          view_componente_curricular.ordenamento AS componente_order,
          view_componente_curricular.abreviatura AS nm_componente_curricular,          
          matricula.ano AS ano,
          curso.nm_curso AS nome_curso,
          serie.nm_serie AS nome_serie,
          turma.nm_turma AS nome_turma          
     FROM pmieducar.instituicao
        INNER JOIN pmieducar.escola ON (escola.ref_cod_instituicao = instituicao.cod_instituicao)
        INNER JOIN pmieducar.escola_curso ON (escola_curso.ref_cod_escola = escola.cod_escola)
        INNER JOIN pmieducar.curso ON (curso.cod_curso = escola_curso.ref_cod_curso)
        INNER JOIN pmieducar.escola_serie ON (escola_serie.ref_cod_escola = escola.cod_escola)
        INNER JOIN pmieducar.serie ON (serie.cod_serie = escola_serie.ref_cod_serie)
        INNER JOIN pmieducar.turma ON (turma.ref_ref_cod_serie = serie.cod_serie)
        LEFT JOIN modules.regra_avaliacao_serie_ano rasa
          ON turma.ano = rasa.ano_letivo
          AND rasa.serie_id = serie.cod_serie
        LEFT JOIN modules.regra_avaliacao ON modules.regra_avaliacao.id = rasa.regra_avaliacao_id
        INNER JOIN pmieducar.turma_turno ON (turma_turno.id = turma.turma_turno_id)
        INNER JOIN pmieducar.matricula_turma ON (matricula_turma.ref_cod_turma = turma.cod_turma)
        INNER JOIN pmieducar.matricula ON (matricula.cod_matricula = matricula_turma.ref_cod_matricula)
        INNER JOIN pmieducar.aluno ON (aluno.cod_aluno = matricula.ref_cod_aluno)
        INNER JOIN cadastro.pessoa ON (pessoa.idpes = aluno.ref_idpes)
        INNER JOIN modules.frequencia_aluno            -- FREQUÊNCIA ALUNO
          ON frequencia_aluno.ref_cod_matricula = matricula.cod_matricula
        INNER JOIN modules.frequencia                  -- FREQUÊNCIA
          ON frequencia.id = frequencia_aluno.ref_frequencia
        INNER JOIN relatorio.view_componente_curricular ON (view_componente_curricular.cod_turma = turma.cod_turma)
        LEFT JOIN modules.nota_aluno ON (nota_aluno.matricula_id = matricula.cod_matricula)																					  
        INNER JOIN relatorio.view_situacao ON (view_situacao.cod_matricula = matricula.cod_matricula
                                              AND view_situacao.sequencial = matricula_turma.sequencial
                                              AND view_situacao.cod_situacao = 9)
        WHERE instituicao.cod_instituicao = {$instituicao}
          AND matricula.ano = {$ano}
          AND escola.cod_escola = {$escola}
          AND curso.cod_curso = {$curso}
          AND serie.cod_serie = {$serie}
          AND turma.cod_turma = {$turma}
          AND matricula.ativo = 1  
          {$data_inicial}
          {$data_final}
          AND (CASE WHEN {$disciplina} = 0 THEN TRUE ELSE view_componente_curricular.id = {$disciplina} END)
        ORDER BY sequencial_fechamento,
            nm_aluno,
            cod_aluno,
            componente_order,
            nm_componente_curricular
";
    }
}
