import React, { useState } from "react";
import Modal from "@/components/elements/Modal";
import { Form, Formik, FormikHelpers } from "formik";
import Field from "@/components/elements/Field";
import { object, string } from "yup";
import createServerDatabase from "@/api/server/databases/createServerDatabase";
import { ServerContext } from "@/state/server";
import { httpErrorToHuman } from "@/api/http";
import FlashMessageRender from "@/components/FlashMessageRender";
import useFlash from "@/plugins/useFlash";
import Button from "@/components/elements/Button";
import tw from "twin.macro";

interface Values {
  databaseName: string;
  connectionsFrom: string;
}

const schema = object().shape({
  databaseName: string()
    .required("โปรดระบุชื่อฐานข้อมูล")
    .min(3, "ชื่อฐานข้อมูลต้องมีอย่างน้อย 3 อักขระ")
    .max(48, "ชื่อฐานข้อมูลต้องไม่เกิน 48 อักขระ")
    .matches(
      /^[\w\-.]{3,48}$/,
      "ชื่อฐานข้อมูลควรประกอบด้วยตัวอักษรและตัวเลขเท่านั้น พร้อมกับตัวอักขระพิเศษเพียงหลายตัวเท่านั้น",
    ),
  connectionsFrom: string().matches(/^[\w\-/.%:]+$/, "โปรดระบุที่อยู่โฮสต์ที่ถูกต้อง"),
});

export default () => {
  const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
  const { addError, clearFlashes } = useFlash();
  const [visible, setVisible] = useState(false);

  const appendDatabase = ServerContext.useStoreActions((actions) => actions.databases.appendDatabase);

  const submit = (values: Values, { setSubmitting }: FormikHelpers<Values>) => {
    clearFlashes("database:create");
    createServerDatabase(uuid, {
      databaseName: values.databaseName,
      connectionsFrom: values.connectionsFrom || "%",
    })
      .then((database) => {
        appendDatabase(database);
        setVisible(false);
      })
      .catch((error) => {
        addError({ key: "database:create", message: httpErrorToHuman(error) });
        setSubmitting(false);
      });
  };

  return (
    <>
      <Formik onSubmit={submit} initialValues={{ databaseName: "", connectionsFrom: "" }} validationSchema={schema}>
        {({ isSubmitting, resetForm }) => (
          <Modal
            visible={visible}
            dismissable={!isSubmitting}
            showSpinnerOverlay={isSubmitting}
            onDismissed={() => {
              resetForm();
              setVisible(false);
            }}
          >
            <FlashMessageRender byKey={"database:create"} css={tw`mb-6`} />
            <h2 css={tw`text-2xl mb-6`}>สร้างฐานข้อมูลใหม่</h2>
            <Form css={tw`m-0`}>
              <Field
                type={"string"}
                id={"database_name"}
                name={"databaseName"}
                label={"ชื่อฐานข้อมูล"}
                description={"ชื่อที่อธิบายความหมายสำหรับฐานข้อมูล"}
              />
              <div css={tw`mt-6`}>
                <Field
                  type={"string"}
                  id={"connections_from"}
                  name={"connectionsFrom"}
                  label={"เชื่อมต่อจากไหนได้บ้าง"}
                  description={
                    "ระบุตำแหน่งที่ควรอนุญาตให้เชื่อมต่อจาก หากปล่อยว่างเปล่า จะอนุญาตให้เชื่อมต่อจากทุกที่"
                  }
                />
              </div>
              <div css={tw`flex flex-wrap justify-end mt-6`}>
                <Button
                  type={"button"}
                  isSecondary
                  css={tw`w-full sm:w-auto sm:mr-2`}
                  onClick={() => setVisible(false)}
                >
                  ยกเลิก
                </Button>
                <Button css={tw`w-full mt-4 sm:w-auto sm:mt-0`} type={"submit"}>
                  สร้างฐานข้อมูล
                </Button>
              </div>
            </Form>
          </Modal>
        )}
      </Formik>
      <Button onClick={() => setVisible(true)}>สร้างฐานข้อมูล</Button>
    </>
  );
};
