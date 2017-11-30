<?php

namespace DoodleBundle\Controller;

use DoodleBundle\Entity\Question;
use DoodleBundle\Forms\QuestionForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Template()
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('DoodleBundle:Question')->findAll();

        return [
            'questions' => $questions,
        ];
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $defaultData = new Question();
        if ($id > 0) {
            $defaultData = $em->getRepository('DoodleBundle:Question')->find($id);
        }

        $form = $this->createForm(QuestionForm::class, $defaultData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Question $updatedQuestion */
            $updatedQuestion = $form->getData();

            $em->persist($updatedQuestion);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('doodle_question_edit', [
                    'id' => $updatedQuestion->getId(),
                ])
            );
        }

        return [
            'form' => $form->createView(),
        ];
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('DoodleBundle:Question')->find($id);

        return [
            'question' => $question,
        ];
    }
}
