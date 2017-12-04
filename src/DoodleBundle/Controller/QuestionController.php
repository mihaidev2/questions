<?php

namespace DoodleBundle\Controller;

use DoodleBundle\Entity\Question;
use DoodleBundle\Forms\QuestionForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Template()
 */
class QuestionController extends Controller 
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $questions = $this->get('db.facade.questions')->getAllQuestions();

        return [
            'questions' => $questions,
        ];
    }

    /**
     * @param Request $request
     * @param
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, $id)
    {
        $questionFacade = $this->get('db.facade.questions');

        $defaultData = $questionFacade->getQuestionByIdOrCreate($id);

        $form = $this->createForm(QuestionForm::class, $defaultData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isvalid()) {
            /** @var Question $updatedQuestion */
            $updatedQuestion = $form->getData();

            $questionFacade->save($updatedQuestion);

            return $this->redirect(
                $this->generateUrl('doodle_question_edit', [
                    'id' => $updatedQuestion->getId(),
                ])
            );
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function viewAction($id)
    {
        $question = $this->get('db.facade.questions')->find($id);

        return [
            'question' => $question,
        ];

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteAction(Request $request)
    {
        $id = $request->request->getInt('id');

        $questionFacade = $this->get('db.facade.questions');

        $question = $questionFacade->find($id);

        if (!$question) {
            return new JsonResponse([
                'code' => 404,
                'message' => 'Question not found',
            ]);
        }

        $question->setStatus(Question::STATUS_DELETED);
        $questionFacade->save($question);

        return new JsonResponse([
            'code' => 200,
        ]);
    }
}
